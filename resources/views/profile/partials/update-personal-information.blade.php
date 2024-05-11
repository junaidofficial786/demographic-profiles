<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Personal Information') }}
        </h2>
    </header>

    <form method="post" action="{{ route('profile.personal-information.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mt-4">
            <x-input-label for="age" :value="__('Age')" />
            <x-text-input id="age" class="block mt-1 w-full" type="number" name="age" :value="__(auth()->user()->age ?? '' )"
                required />
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>

        {{-- gender --}}
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Gender')" />
            <select id="gender" name="gender"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required>
                <option value="">Select Gender</option>
                <option value="male" {{ auth()->user()->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ auth()->user()->gender == 'female' ? 'selected' : '' }}>Female</option>
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
                    <option value="{{ $key }}" {{ auth()->user()->province == $key ? 'selected' : '' }}>{{ $key }}</option>
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
                <option value="{{ auth()->user()->city }}">{{ auth()->user()->city }}</option>
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
                <option value="full_time" {{ auth()->user()->employement_status == 'full_time' ? 'selected' : '' }}>Full-time</option>
                <option value="part_time" {{ auth()->user()->employement_status == 'part_time' ? 'selected' : '' }}>Part-time</option>
                <option value="temporary" {{ auth()->user()->employement_status == 'temporary' ? 'selected' : '' }}>Temporary</option>
                <option value="contract" {{ auth()->user()->employement_status == 'contract' ? 'selected' : '' }}>Contract</option>
                <option value="freelance" {{ auth()->user()->employement_status == 'freelance' ? 'selected' : '' }}>Freelance</option>
                <option value="seasonal" {{ auth()->user()->employement_status == 'seasonal' ? 'selected' : '' }}>Seasonal</option>
                <option value="intern" {{ auth()->user()->employement_status == 'intern' ? 'selected' : '' }}>Intern</option>
                <option value="probationary" {{ auth()->user()->employement_status == 'probationary' ? 'selected' : '' }}>Probationary</option>
                <option value="probationary" {{ auth()->user()->employement_status == 'probationary' ? 'selected' : '' }}>Casual</option>
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
                <option value="associate" {{ auth()->user()->degree_level == 'associate' ? 'selected' : '' }}>Associate's Degree</option>
                <option value="bachelor" {{ auth()->user()->degree_level == 'bachelor' ? 'selected' : '' }}>Bachelor's Degree</option>
                <option value="master" {{ auth()->user()->degree_level == 'master' ? 'selected' : '' }}>Master's Degree</option>
                <option value="doctorate" {{ auth()->user()->degree_level == 'doctorate' ? 'selected' : '' }}>Doctorate (Ph.D.)</option>
                <option value="certificate" {{ auth()->user()->degree_level == 'certificate' ? 'selected' : '' }}>Certificate</option>
            </select>
            <x-input-error :messages="$errors->get('degree_level')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'personal-information-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
