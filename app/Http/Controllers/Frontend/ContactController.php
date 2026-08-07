<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255', 'email' => 'required|email', 'phone' => 'nullable|string', 'subject' => 'nullable|string', 'message' => 'required|string']);
        ContactMessage::create($request->only('name', 'email', 'phone', 'subject', 'message'));
        return back()->with('success', 'Message sent successfully!');
    }
}
