<section>
    <header>
        <!-- <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Phone Number') }}
        </h2> -->
        <h2 class="text-lg font-medium text-gray-900 main-heading">
            {{ __('Update Phone Number') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 tag-line">
            {{ __("Update your phone number.") }}
        </p>

    </header>

    @if (session('status') === 'otp-sent')
        <form method="post" action="{{ route('otp.verification') }}" class="mt-6 space-y-6">
        @method('post')
    @else
        <form method="post" action="{{ route('phone.update') }}" class="mt-6 space-y-6">
        @method('patch')
    @endif
    
        @csrf
        
        <div>
            <x-input-label for="username" :value="__('Phone')" />
            <x-text-input readonly id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('New Phone Number')" />
            <!-- <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="isset($phone) ? $phone : old('phone')" required autocomplete="phone" /> -->
            <x-text-input 
                id="phone" 
                name="phone" 
                type="tel" 
                class="mt-1 block w-full" 
                :value="session('status') === 'otp-sent' ? session('phone') : null" 
                required 
                autocomplete="phone" 
            />

            

            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

            @if (session('status') === 'otp-sent')
            
                <div>
                    <x-input-label for="otp" :value="__('OTP (Please provide OTP)')" />
                    <x-text-input 
                        id="otp" 
                        name="otp" 
                        type="number" 
                        class="mt-1 block w-full"  
                        required 
                        autocomplete="otp" 
                    />
                    <x-input-error class="mt-1 block w-full"  :messages="$errors->get('otp')" />
                </div>
            @endif

        <div class="flex items-center gap-4">
        
        <x-primary-button class="add-btn" >
            {{ (session('status') === 'otp-sent') ? __('Verify Otp') : __('Send Otp') }}
        </x-primary-button >

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif

            @if (session('err') === 'failed')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Please Enter Valid OTP.') }}</p>
            @endif
        </div>
    </form>
</section>
