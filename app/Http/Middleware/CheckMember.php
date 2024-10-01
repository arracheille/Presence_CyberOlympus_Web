<?php

namespace App\Http\Middleware;

use App\Models\Member;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $workspaceId = $request->route('workspace')->id;
        // $userId = auth()->user()->id;
        // $isMember = Member::where('workspace_id', $workspaceId)
        //                   ->where('user_id', $userId)
        //                   ->exists();
        // if (!$isMember) {
        //     re turn redirect()->back()->with('error', 'You do not have access to this workspace.');
        // }
        return $next($request);
    }
}
