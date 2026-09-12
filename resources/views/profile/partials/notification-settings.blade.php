<form method="post" action="{{ route('notifications.preferences.update') }}">
    @csrf
    <div class="userProfileDtls themeform">
        <div class="fieldsItems pb-8">
            <h4 class="text-base font-bold text-black mb-1">Notification Preferences</h4>
            <h6 class="text-xs text-[#5C5C5C] mb-6">
                Choose which activity you want to be notified about. Turning a category off stops new
                notifications for it — nothing that already happened is deleted.
            </h6>

            <div class="space-y-1">
                @foreach(\App\Models\NotificationPreference::CATEGORIES as $category)
                    @php $checked = $notificationPreferences[$category] ?? true; @endphp
                    <label class="flex items-center justify-between gap-4 py-3 px-4 border-b border-[#D2DDDB] last:border-b-0 cursor-pointer">
                        <span class="text-sm font-medium text-black">{{ $category }}</span>
                        <input
                            type="checkbox"
                            name="categories[]"
                            value="{{ $category }}"
                            {{ $checked ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-[#D2DDDB] text-themegreen focus:ring-themegreen"
                        >
                    </label>
                @endforeach
            </div>
        </div>

        <div class="text-center lg:text-left">
            <button type="submit" class="themeBtn">Save Preferences</button>
        </div>
    </div>
</form>
