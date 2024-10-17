<?php

namespace App\Http\Controllers;

use App\Mail\SendCode;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\CodeUnit\FunctionUnit;

class CodeController extends Controller
{
    public function sendUniqueCode(Request $request) {
        $findWorkspace = Workspace::where('unique_code', $request->unique_code)->first();
        if ($findWorkspace) {
            $toEmail = $request->email;
            $message = 'Click this button to join the workspace: ';
            $subject = 'Workspace Invitation';
            Mail::to($toEmail)->send(new SendCode($message, $subject, $findWorkspace));
            return redirect()->back()->with('success', 'Invitation sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Workspace not found!');
        }
    }
    
    // $findWorkspace = Workspace::where('unique_code', $request->unique_code)->first();
    // if ($findWorkspace) {
    //     $insertMember = new Member();
    //     $insertMember->user_id      = auth()->user()->id;
    //     $insertMember->email        = $request->email;
    //     $insertMember->workspace_id = $findWorkspace->id;
    //     $insertMember->unique_code  = $findWorkspace->unique_code;
    //     $insertMember->save();

    //     $toEmail = $request->email;
    //     $message = 'Workspace Code: ' . $findWorkspace->unique_code;
    //     $subject = 'Your Workspace Unique Code';

    //     Mail::to($toEmail)->send(new SendCode($message, $subject));
    //     return redirect()->back()->with('success', 'Invitation sent successfully!');
    // } else {
    //     return redirect()->back()->with('error', 'Workspace not found!');
    // }
}
