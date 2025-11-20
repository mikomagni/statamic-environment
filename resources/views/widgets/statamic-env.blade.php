<ui-card class="env_{{ $env }} env_type_{{ $env_type }}">
    <div class="p-0">
        @if ($env_type !== 'undefined')
            <p class="flex items-center gap-2 text-sm">
                <span>{{ $env_icon }}</span>
                <span>{!! __('statamic_environment::widget.viewing_version', ['label' => $env_label, 'app_name' => "<strong><a target='_blank' href='{$app_url}' class='text-blue hover:text-blue-600'>{$app_name}</a></strong>"]) !!}</span>
            </p>
        @else
            <p class="flex items-center gap-2 text-sm">
                <span>{{ $env_icon }}</span>
                <span>{{ __('statamic_environment::widget.unusual_env_detected', ['env' => $env]) }}</span>
            </p>
        @endif
    </div>
</ui-card>

@if ($show_details)
    <ui-heading class="mt-4 mb-2" size="sm" :text="__('statamic_environment::widget.environment')" />

    <ui-card class="p-0">
        <ui-table>
            <ui-table-columns>
                <ui-table-column class="w-[40%] uppercase"><ui-badge color="green" pill>Setting</ui-badge></ui-table-column>
                <ui-table-column class="w-[60%] uppercase"><ui-badge color="green" pill>Value</ui-badge></ui-table-column>
            </ui-table-columns>
            <ui-table-rows>
                <ui-table-row>
                    <ui-table-cell>
                        {{ __('statamic_environment::widget.app_name') }}
                    </ui-table-cell>
                    <ui-table-cell>
                        <ui-code>{{ $app_name }}</ui-code>
                    </ui-table-cell>
                </ui-table-row>

                <ui-table-row>
                    <ui-table-cell>
                        {{ __('statamic_environment::widget.app_env') }}
                    </ui-table-cell>
                    <ui-table-cell>
                        <ui-code>{{ $env }}</ui-code>
                    </ui-table-cell>
                </ui-table-row>

                <ui-table-row>
                    <ui-table-cell>
                        {{ __('statamic_environment::widget.app_debug') }}
                    </ui-table-cell>
                    <ui-table-cell>
                        <ui-code>
                            {{ env('APP_DEBUG') == 'true' ? __('statamic_environment::widget.true') : __('statamic_environment::widget.false') }}
                        </ui-code>
                    </ui-table-cell>
                </ui-table-row>

                <ui-table-row>
                    <ui-table-cell>
                        {{ __('statamic_environment::widget.app_url') }}
                    </ui-table-cell>
                    <ui-table-cell>
                        <ui-code>{{ $app_url }}</ui-code>
                    </ui-table-cell>
                </ui-table-row>

                <ui-table-row>
                    <ui-table-cell>
                        {!! !empty(env('MAIL_DRIVER')) ? __('statamic_environment::widget.mail_driver') : __('statamic_environment::widget.mail_mailer') !!}
                    </ui-table-cell>
                    <ui-table-cell>
                        <ui-code>{{ !empty(env('MAIL_DRIVER')) ? env('MAIL_DRIVER') : env('MAIL_MAILER') }}</ui-code>
                    </ui-table-cell>
                </ui-table-row>

                <ui-table-row>
                    <ui-table-cell>
                        {{ __('statamic_environment::widget.mail_from_address') }}
                    </ui-table-cell>
                    <ui-table-cell>
                        <ui-code>{{ $mail_from_address }}</ui-code>
                    </ui-table-cell>
                </ui-table-row>

                <ui-table-row>
                    <ui-table-cell>
                        {{ __('statamic_environment::widget.statamic_git_enabled') }}
                    </ui-table-cell>
                    <ui-table-cell>
                        <ui-code>
                            {{ env('STATAMIC_GIT_ENABLED') == 'true' ? __('statamic_environment::widget.true') : __('statamic_environment::widget.false') }}
                        </ui-code>
                    </ui-table-cell>
                </ui-table-row>

                <ui-table-row>
                    <ui-table-cell>
                        {{ __('statamic_environment::widget.statamic_git_push') }}
                    </ui-table-cell>
                    <ui-table-cell>
                        <ui-code>
                            {{ env('STATAMIC_GIT_PUSH') == 'true' ? __('statamic_environment::widget.true') : __('statamic_environment::widget.false') }}
                        </ui-code>
                    </ui-table-cell>
                </ui-table-row>

                <ui-table-row>
                    <ui-table-cell>
                        STATAMIC_STATIC_CACHING_STRATEGY
                    </ui-table-cell>
                    <ui-table-cell>
                        <ui-code>{{ env('STATAMIC_STATIC_CACHING_STRATEGY') ?? 'null' }}</ui-code>
                    </ui-table-cell>
                </ui-table-row>

                <ui-table-row>
                    <ui-table-cell>
                        DEBUGBAR_ENABLED
                    </ui-table-cell>
                    <ui-table-cell>
                        <ui-code>
                            {{ env('DEBUGBAR_ENABLED') == 'true' ? __('statamic_environment::widget.true') : __('statamic_environment::widget.false') }}
                        </ui-code>
                    </ui-table-cell>
                </ui-table-row>
            </ui-table-rows>
        </ui-table>
    </ui-card>
@endif
