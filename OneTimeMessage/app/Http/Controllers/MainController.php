<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\FormSubmitRequest;
use App\Mail\EmailConfirmationMessage;
use App\Mail\EmailMessageReaded;
use App\Mail\EmailReadMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function message_submit(FormSubmitRequest $request): RedirectResponse
    {
        $purl_code = Str::random(36);

        $message = new Message();
        $message->send_from = $request->input('input_email_from');
        $message->send_to = $request->input('input_email_to');
        $message->message = $request->input('email_message');
        $message->purl_confirmation = $purl_code;
        $message->save();

        //envia um email para confirmar a menssagem
        Mail::to($request->input('input_email_from'))->send(new EmailConfirmationMessage($purl_code));

        Log::channel('vigilans')->info("Email de confirmação enviado para {email}", [
            'email' => $request->input('input_email_from')
        ]);

        //data e hora do envio da confirmação
        $message->purl_confirmation_sent = now();
        $message->save();

        session()->flash('success', "Foi enviado um email de confirmação para: " . $request->input('input_email_from'));

        return redirect()->route('home');
    }

    public function confirm_message(string $purl): RedirectResponse
    {
        $result = Message::where('purl_confirmation', '=', $purl)->first();

        //verifica se existe um purl e redireciona para a home caso não exista o purl
        if ($result === null) {
            return redirect()->route('home');
        }

        //remove o purl_confirmation, cria o purl_read e atualiza o purl_read_sent
        $purl_code = Str::random(36);
        Message::where('purl_confirmation', '=', $purl)->update([
            'purl_confirmation' => null,
            'purl_read' => $purl_code,
            'purl_read_sent' => now()
        ]);

        //envia o email para o receptor
        Mail::to($result->send_to)->send(new EmailReadMessage($purl_code));

        Log::channel('vigilans')->info("Menssagem enviada com sucesso para o receptor {email}", [
            'email' => $result->send_to
        ]);

        session()->flash('confirm', 'Menssagem enviada com sucesso para: ' . $result->send_to);

        return redirect()->route('home');
    }

    public function read_message(string $purl): View|RedirectResponse
    {
        $message = Message::select('message', 'send_from', 'send_to')
            ->where('purl_read', '=', $purl)
            ->first();

        if ($message === null) {
            return redirect()->route('home');
        }

        Mail::to($message->send_from)->send(new EmailMessageReaded(now(), $message->send_to));

        Message::where('purl_read', '=', $purl)->delete();

        Message::withTrashed()->where('purl_read', '=', $purl)->update([
            'purl_read' => null,
            'message_read' => now()
        ]);

        return view('message_read', [
            'message' => $message->message,
            'sender' => $message->send_from
        ]);
    }
}
