<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject ?? 'رسالة جديدة من الموقع',
            'content' => $request->message,
        ];

        try {
            Mail::send([], [], function ($message) use ($data) {
                $message
                    ->to(env('MAIL_FROM_ADDRESS', 'admin@example.com'))
                    ->subject('📬 ' . $data['subject'] . ' - من ' . $data['name'])
                    ->html(
                        '<div style="font-family: Arial; padding:20px; max-width:600px; margin:auto; background:#f9f9f9; border-radius:10px;">'
                        . '<h2 style="color:#00ffff;">رسالة جديدة من الموقع</h2>'
                        . '<hr>'
                        . '<p><strong>الاسم:</strong> ' . e($data['name']) . '</p>'
                        . '<p><strong>البريد:</strong> ' . e($data['email']) . '</p>'
                        . '<p><strong>الموضوع:</strong> ' . e($data['subject']) . '</p>'
                        . '<hr>'
                        . '<p style="font-size:15px;line-height:1.7;">' . nl2br(e($data['content'])) . '</p>'
                        . '<hr>'
                        . '<small style="color:#888;">هذه الرسالة أرسلت من نموذج الاتصال في الموقع</small>'
                        . '</div>'
                    );
            });

            return response()->json([
                'status' => true,
                'message' => 'تم إرسال الرسالة بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'فشل إرسال الرسالة: ' . $e->getMessage()
            ], 500);
        }
    }
}
