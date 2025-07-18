<div class="p-0 card content env_{{ $env }} env_type_{{ $env_type }}"
>
    <div class="py-2 px-4">
        @if ($env_type !== 'undefined')
        <p><span class="mr-2">{{ $env_icon }}</span> {!! __('statamic_environment::widget.viewing_version', ['label' => $env_label, 'app_name' => "<b><a target='_blank' href='{$app_url}'>{$app_name}</a></b>"]) !!}</p>
        @else
        <p><span class="mr-2">{{ $env_icon }}</span> {{ __('statamic_environment::widget.unusual_env_detected', ['env' => $env]) }}</p>
        @endif
    </div>
</div>

@if ($show_details)
    <h3 class="pl-0 mb-1 little-heading">{{ __('statamic_environment::widget.environment') }}</h3>
    <div class="p-0 mb-2 card">
        <table class="data-table">
            <tbody>
                <tr>
                    <td class="w-1/4 py-1 pl-2">
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="11.985" r="11.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></circle><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M.673 9.985h6.084a3 3 0 0 1 2.122.878L10 11.984a3 3 0 0 1 .121 4.115l-1.363 1.533A3 3 0 0 0 8 19.625v3.145M20.261 3.985h-5.8a2.25 2.25 0 0 0 0 4.5h.432a3 3 0 0 1 2.5 1.335l2.218 3.329a3 3 0 0 0 2.5 1.336h1.121"></path></svg>
                            </div>
                            {{ __('statamic_environment::widget.app_name') }}
                        </div>
                    </td>
                    <td>
                        <code>
                       {{ $app_name }}
                        </code>
                    </td>
                </tr>
                <tr>
                    <td class="w-1/4 py-1 pl-2">
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="11.985" r="11.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></circle><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M.673 9.985h6.084a3 3 0 0 1 2.122.878L10 11.984a3 3 0 0 1 .121 4.115l-1.363 1.533A3 3 0 0 0 8 19.625v3.145M20.261 3.985h-5.8a2.25 2.25 0 0 0 0 4.5h.432a3 3 0 0 1 2.5 1.335l2.218 3.329a3 3 0 0 0 2.5 1.336h1.121"></path></svg>
                            </div>
                            {{ __('statamic_environment::widget.app_env') }}
                        </div>
                    </td>
                    <td>
                        <code>
                       {{ $env }}
                        </code>
                    </td>
                </tr>
                <tr>
                    <td class="w-1/4 py-1 pl-2">
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="11.985" r="11.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></circle><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M.673 9.985h6.084a3 3 0 0 1 2.122.878L10 11.984a3 3 0 0 1 .121 4.115l-1.363 1.533A3 3 0 0 0 8 19.625v3.145M20.261 3.985h-5.8a2.25 2.25 0 0 0 0 4.5h.432a3 3 0 0 1 2.5 1.335l2.218 3.329a3 3 0 0 0 2.5 1.336h1.121"></path></svg>
                            </div>
                            {{ __('statamic_environment::widget.app_debug') }}
                        </div>
                    </td>
                    <td>
                        <code>
                        @if (env('APP_DEBUG')=='true')
                        {{ __('statamic_environment::widget.true') }}
                        @else
                        {{ __('statamic_environment::widget.false') }}
                        @endif
                        </code>
                    </td>
                </tr>
                <tr>
                    <td class="w-1/4 py-1 pl-2">
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="11.985" r="11.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></circle><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M.673 9.985h6.084a3 3 0 0 1 2.122.878L10 11.984a3 3 0 0 1 .121 4.115l-1.363 1.533A3 3 0 0 0 8 19.625v3.145M20.261 3.985h-5.8a2.25 2.25 0 0 0 0 4.5h.432a3 3 0 0 1 2.5 1.335l2.218 3.329a3 3 0 0 0 2.5 1.336h1.121"></path></svg>
                            </div>
                            {{ __('statamic_environment::widget.statamic_git_enabled') }}
                        </div>
                    </td>
                    <td>
                        <code>
                        @if (env('STATAMIC_GIT_ENABLED')=='true')
                        {{ __('statamic_environment::widget.true') }}
                        @else
                        {{ __('statamic_environment::widget.false') }}
                        @endif
                        </code>
                    </td>
                </tr>
                <tr>
                    <td class="w-1/4 py-1 pl-2">
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="11.985" r="11.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></circle><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M.673 9.985h6.084a3 3 0 0 1 2.122.878L10 11.984a3 3 0 0 1 .121 4.115l-1.363 1.533A3 3 0 0 0 8 19.625v3.145M20.261 3.985h-5.8a2.25 2.25 0 0 0 0 4.5h.432a3 3 0 0 1 2.5 1.335l2.218 3.329a3 3 0 0 0 2.5 1.336h1.121"></path></svg>
                            </div>
                            {{ __('statamic_environment::widget.statamic_git_push') }}
                        </div>
                    </td>
                    <td>
                        <code>
                        @if (env('STATAMIC_GIT_PUSH')=='true')
                        {{ __('statamic_environment::widget.true') }}
                        @else
                        {{ __('statamic_environment::widget.false') }}
                        @endif
                        </code>
                    </td>
                </tr>
                <tr>
                    <td class="w-1/4 py-1 pl-2">
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="11.985" r="11.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></circle><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M.673 9.985h6.084a3 3 0 0 1 2.122.878L10 11.984a3 3 0 0 1 .121 4.115l-1.363 1.533A3 3 0 0 0 8 19.625v3.145M20.261 3.985h-5.8a2.25 2.25 0 0 0 0 4.5h.432a3 3 0 0 1 2.5 1.335l2.218 3.329a3 3 0 0 0 2.5 1.336h1.121"></path></svg>
                            </div>
                            {!! !empty(env('MAIL_DRIVER')) ?  __('statamic_environment::widget.mail_driver') : __('statamic_environment::widget.mail_mailer') !!}
                        </div>
                    </td>
                    <td>
                        <code>
                        {!! !empty(env('MAIL_DRIVER')) ?  env('MAIL_DRIVER') : env('MAIL_MAILER') !!}

                        </code>
                    </td>
                </tr>
                <tr>
                    <td class="w-1/4 py-1 pl-2">
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="11.985" r="11.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></circle><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M.673 9.985h6.084a3 3 0 0 1 2.122.878L10 11.984a3 3 0 0 1 .121 4.115l-1.363 1.533A3 3 0 0 0 8 19.625v3.145M20.261 3.985h-5.8a2.25 2.25 0 0 0 0 4.5h.432a3 3 0 0 1 2.5 1.335l2.218 3.329a3 3 0 0 0 2.5 1.336h1.121"></path></svg>
                            </div>
                            {{ __('statamic_environment::widget.mail_from_address') }}
                        </div>
                    </td>
                    <td>
                        <code>
                       {{ $mail_from_address }}
                        </code>
                    </td>
                </tr>
                <tr>
                    <td class="w-1/4 py-1 pl-2">
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="11.985" r="11.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></circle><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M.673 9.985h6.084a3 3 0 0 1 2.122.878L10 11.984a3 3 0 0 1 .121 4.115l-1.363 1.533A3 3 0 0 0 8 19.625v3.145M20.261 3.985h-5.8a2.25 2.25 0 0 0 0 4.5h.432a3 3 0 0 1 2.5 1.335l2.218 3.329a3 3 0 0 0 2.5 1.336h1.121"></path></svg>
                            </div>
                            {{ __('statamic_environment::widget.app_url') }}
                        </div>
                    </td>
                    <td>
                        <code>
                       {{ $app_url }}
                        </code>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endif
