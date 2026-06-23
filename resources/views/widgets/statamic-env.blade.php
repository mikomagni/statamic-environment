<div class="@container/panel relative bg-gray-150 [.bg-architectural-lines_&]:backdrop-blur-[10px] dark:bg-gray-950/35 dark:inset-shadow-2xs dark:inset-shadow-black w-full rounded-2xl mb-8 max-[600px]:p-1.25 p-1.75 focus-none starting-style-transition starting-style-transition--siblings env_{{ $env }} env_type_{{ $env_type }}" data-ui-panel>
    <div class="bg-white dark:bg-gray-850 rounded-xl shadow-ui-md" data-ui-card data-inset="true">
        <p class="flex items-center gap-2 text-sm py-3 px-5">
            <span>{{ $env_icon }}</span>
            @if ($env_type !== 'undefined')
                <span>{!! __('statamic_environment::widget.viewing_version', ['label' => $env_label, 'app_name' => "<strong><a target='_blank' href='{$app_url}' class='text-blue hover:text-blue-600'>{$app_name}</a></strong>"]) !!}</span>
            @else
                <span>{{ __('statamic_environment::widget.unusual_env_detected', ['env' => $env]) }}</span>
            @endif
        </p>
    </div>
</div>

@if ($show_details)
<div class="@container/panel relative bg-gray-150 [.bg-architectural-lines_&]:backdrop-blur-[10px] dark:bg-gray-950/35 dark:inset-shadow-2xs dark:inset-shadow-black w-full rounded-2xl mb-8 max-[600px]:p-1.25 p-1.75 [&:has([data-ui-panel-header])]:pt-0 focus-none starting-style-transition starting-style-transition--siblings" data-ui-panel>
    <header class="px-4.5 py-3" data-ui-panel-header>
        <div class="font-medium antialiased flex items-center justify-between text-sm tracking-tight text-gray-700 dark:text-white" data-ui-heading>
            <span class="w-[40%]">Setting</span>
            <span class="w-[60%]">Value</span>
        </div>
    </header>
    <div class="bg-white dark:bg-gray-850 rounded-xl shadow-ui-md divide-y dark:divide-y-[0.75px] divide-gray-200 dark:divide-gray-700 text-sm text-gray-600 dark:text-gray-400" data-ui-card data-inset="true">
            <div class="flex items-center justify-between py-2 ps-5 pe-3">
                <span>{{ __('statamic_environment::widget.app_name') }}</span>
                <span>{{ $app_name }}</span>
            </div>
            <div class="flex items-center justify-between py-2 ps-5 pe-3">
                <span>{{ __('statamic_environment::widget.app_env') }}</span>
                <span>{{ $env }}</span>
            </div>
            <div class="flex items-center justify-between py-2 ps-5 pe-3">
                <span>{{ __('statamic_environment::widget.app_debug') }}</span>
                <span>{{ env('APP_DEBUG') == 'true' ? __('statamic_environment::widget.true') : __('statamic_environment::widget.false') }}</span>
            </div>
            <div class="flex items-center justify-between py-2 ps-5 pe-3">
                <span>{{ __('statamic_environment::widget.app_url') }}</span>
                <span>{{ $app_url }}</span>
            </div>
            <div class="flex items-center justify-between py-2 ps-5 pe-3">
                <span>{!! !empty(env('MAIL_DRIVER')) ? __('statamic_environment::widget.mail_driver') : __('statamic_environment::widget.mail_mailer') !!}</span>
                <span>{{ !empty(env('MAIL_DRIVER')) ? env('MAIL_DRIVER') : env('MAIL_MAILER') }}</span>
            </div>
            <div class="flex items-center justify-between py-2 ps-5 pe-3">
                <span>{{ __('statamic_environment::widget.mail_from_address') }}</span>
                <span>{{ $mail_from_address }}</span>
            </div>
            <div class="flex items-center justify-between py-2 ps-5 pe-3">
                <span>{{ __('statamic_environment::widget.statamic_git_enabled') }}</span>
                <span>{{ env('STATAMIC_GIT_ENABLED') == 'true' ? __('statamic_environment::widget.true') : __('statamic_environment::widget.false') }}</span>
            </div>
            <div class="flex items-center justify-between py-2 ps-5 pe-3">
                <span>{{ __('statamic_environment::widget.statamic_git_push') }}</span>
                <span>{{ env('STATAMIC_GIT_PUSH') == 'true' ? __('statamic_environment::widget.true') : __('statamic_environment::widget.false') }}</span>
            </div>
            <div class="flex items-center justify-between py-2 ps-5 pe-3">
                <span>STATAMIC_STATIC_CACHING_STRATEGY</span>
                <span>{{ env('STATAMIC_STATIC_CACHING_STRATEGY') ?? 'null' }}</span>
            </div>
            <div class="flex items-center justify-between py-2 ps-5 pe-3">
                <span>DEBUGBAR_ENABLED</span>
                <span>{{ env('DEBUGBAR_ENABLED') == 'true' ? __('statamic_environment::widget.true') : __('statamic_environment::widget.false') }}</span>
            </div>
        </div>
</div>
@endif
