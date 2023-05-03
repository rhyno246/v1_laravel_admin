<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    use DeleteModelTrait, DeleteSelectedTrait;
    private $message;
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function index()
    {
        $data = $this->message->latest()->get();
        return view('backend.pages.message.index', compact('data'));
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->message->firstOrCreate([
                "email" => $request->email,
                "name" => $request->name,
                "subject" => $request->subject,
                "message" => $request->message
            ]);
            DB::commit();
            return redirect()->route('home');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }
    public function view($email)
    {
        $data = $this->message->where('email', $email)->first();
        return view('backend.pages.message.view', compact('data'));
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->message);
    }
    public function deleteSelected(Request $request)
    {
        if ($request->ajax()) {
            return $this->deleteSelectedTrait($request->ids, $this->message);
        }
    }

    public function sendMail(Request $request)
    {
        Mail::send('backend.pages.message.template', ['body' => $request->message, 'title' => $request->subject], function ($message) use ($request) {
            $message->from('test@gmail.com', 'ShopOnline');
            $message->to($request->email, 'ShopOnline')->subject('ShopOnline trả lời phản hồi của bạn');
        });
        return redirect()->route('message.index')->with('message', 'Gửi phản hồi thành công');
    }
}
