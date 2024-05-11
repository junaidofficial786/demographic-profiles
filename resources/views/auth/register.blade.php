<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Age --}}
        <div class="mt-4">
            <x-input-label for="age" :value="__('Age')" />
            <x-text-input id="age" class="block mt-1 w-full" type="number" name="age" :value="old('age')"
                required  />
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>

        {{-- gender --}}
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Gender')" />
            <select id="gender" name="gender"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        {{-- province --}}
        <div class="mt-4">
            <x-input-label for="province" :value="__('Province')" />
            <select id="province" name="province"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required>
                <option value="">Select Province</option>
                @foreach (config('cities') as $key => $value)
                    <option value="{{ $key }}">{{ $key }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('province')" class="mt-2" />
        </div>

        {{-- city --}}
        <div class="mt-4">
            <x-input-label for="city" :value="__('City')" />
            <select id="city" name="city"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required>
            </select>
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        {{-- employement status --}}
        <div class="mt-4">
            <x-input-label for="employement_status" :value="__('Employement Status')" />
            <select id="employement_status" name="employement_status"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required>
                <option value="">Select Employment Status</option>
                <option value="full_time">Full-time</option>
                <option value="part_time">Part-time</option>
                <option value="temporary">Temporary</option>
                <option value="contract">Contract</option>
                <option value="freelance">Freelance</option>
                <option value="seasonal">Seasonal</option>
                <option value="intern">Intern</option>
                <option value="probationary">Probationary</option>
                <option value="casual">Casual</option>
            </select>
            <x-input-error :messages="$errors->get('employement_status')" class="mt-2" />
        </div>

        {{-- degree level --}}
        <div class="mt-4">
            <x-input-label for="degree_level" :value="__('Degree Level')" />
            <select id="degree_level" name="degree_level"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required>
                <option value="">Select Degree Level</option>
                <option value="associate">Associate's Degree</option>
                <option value="bachelor">Bachelor's Degree</option>
                <option value="master">Master's Degree</option>
                <option value="doctorate">Doctorate (Ph.D.)</option>
                <option value="certificate">Certificate</option>
            </select>
            <x-input-error :messages="$errors->get('degree_level')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>


