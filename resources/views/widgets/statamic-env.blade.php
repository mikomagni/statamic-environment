<ui-widget class="env_{{ $env }} env_type_{{ $env_type }}">
    <div class="flex items-center gap-2 px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700">
        <span>{{ $env_icon }}</span>
        @if ($env_type !== 'undefined')
            <span>{!! __('statamic_environment::widget.viewing_version', ['label' => $env_label, 'app_name' => "<strong><a target='_blank' href='{$app_url}' class='text-blue hover:text-blue-600'>{$app_name}</a></strong>"]) !!}</span>
        @else
            <span>{{ __('statamic_environment::widget.unusual_env_detected', ['env' => $env]) }}</span>
        @endif
    </div>

    @if ($show_details)
        <div class="px-4">
            <ui-table>
                <ui-table-columns>
                    <ui-table-column>Setting</ui-table-column>
                    <ui-table-column>Value</ui-table-column>
                </ui-table-columns>
                <ui-table-rows>
                    <ui-table-row>
                        <ui-table-cell>{{ __('statamic_environment::widget.app_name') }}</ui-table-cell>
                        <ui-table-cell>{{ $app_name }}</ui-table-cell>
                    </ui-table-row>
                    <ui-table-row>
                        <ui-table-cell>{{ __('statamic_environment::widget.app_env') }}</ui-table-cell>
                        <ui-table-cell>{{ $env }}</ui-table-cell>
                    </ui-table-row>
                    <ui-table-row>
                        <ui-table-cell>{{ __('statamic_environment::widget.app_debug') }}</ui-table-cell>
                        <ui-table-cell>{{ $app_debug ? __('statamic_environment::widget.true') : __('statamic_environment::widget.false') }}</ui-table-cell>
                    </ui-table-row>
                    <ui-table-row>
                        <ui-table-cell>{{ __('statamic_environment::widget.app_url') }}</ui-table-cell>
                        <ui-table-cell>{{ $app_url }}</ui-table-cell>
                    </ui-table-row>
                    <ui-table-row>
                        <ui-table-cell>{{ __('statamic_environment::widget.mail_mailer') }}</ui-table-cell>
                        <ui-table-cell>{{ $mail_mailer }}</ui-table-cell>
                    </ui-table-row>
                    <ui-table-row>
                        <ui-table-cell>{{ __('statamic_environment::widget.mail_from_address') }}</ui-table-cell>
                        <ui-table-cell>{{ $mail_from_address }}</ui-table-cell>
                    </ui-table-row>
                    <ui-table-row>
                        <ui-table-cell>{{ __('statamic_environment::widget.statamic_git_enabled') }}</ui-table-cell>
                        <ui-table-cell>{{ $git_enabled ? __('statamic_environment::widget.true') : __('statamic_environment::widget.false') }}</ui-table-cell>
                    </ui-table-row>
                    <ui-table-row>
                        <ui-table-cell>{{ __('statamic_environment::widget.statamic_git_push') }}</ui-table-cell>
                        <ui-table-cell>{{ $git_push ? __('statamic_environment::widget.true') : __('statamic_environment::widget.false') }}</ui-table-cell>
                    </ui-table-row>
                    <ui-table-row>
                        <ui-table-cell>STATAMIC_STATIC_CACHING_STRATEGY</ui-table-cell>
                        <ui-table-cell>{{ $static_caching_strategy ?? 'null' }}</ui-table-cell>
                    </ui-table-row>
                    <ui-table-row>
                        <ui-table-cell>DEBUGBAR_ENABLED</ui-table-cell>
                        <ui-table-cell>{{ $debugbar_enabled ? __('statamic_environment::widget.true') : __('statamic_environment::widget.false') }}</ui-table-cell>
                    </ui-table-row>
                </ui-table-rows>
            </ui-table>
        </div>
    @endif
</ui-widget>
