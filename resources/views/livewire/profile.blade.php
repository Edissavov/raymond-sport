<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Navigation -->
        <div class="md:w-1/4">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold">Account Settings</h2>
                </div>
                <nav class="space-y-1 p-4">
                    <a
                        href="{{ route('profile.info') }}"
                        @class([
                            'block w-full text-left px-4 py-2 text-sm font-medium rounded-md transition',
                            'bg-blue-50 text-blue-700' => request()->routeIs('profile.info'),
                            'text-gray-600 hover:text-gray-900 hover:bg-gray-50' => !request()->routeIs('profile.info')
                        ])
                        wire:navigate
                    >
                        Profile Information
                    </a>
                    <a
                        href="{{ route('profile.orders') }}"
                        @class([
                            'block w-full text-left px-4 py-2 text-sm font-medium rounded-md transition',
                            'bg-blue-50 text-blue-700' => request()->routeIs('profile.orders'),
                            'text-gray-600 hover:text-gray-900 hover:bg-gray-50' => !request()->routeIs('profile.orders')
                        ])
                        wire:navigate
                    >
                        Order History
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="md:w-3/4">
            @if(request()->routeIs('profile.info'))
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold">Profile Information</h2>
                        <p class="text-sm text-gray-500 mt-1">Update your account's profile information.</p>
                    </div>
                    <div class="p-6">
                        @if(session('message'))
                            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="updateProfile">
                            <div class="grid grid-cols-1 gap-6">


                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input
                                        type="text"
                                        id="name"
                                        wire:model="name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    >
                                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input
                                        type="email"
                                        id="email"
                                        wire:model="email"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    >
                                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Address -->
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                    <input
                                        type="text"
                                        id="address"
                                        wire:model="address"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    >
                                    @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                    <input
                                        type="text"
                                        id="phone"
                                        wire:model="phone"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    >
                                    @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="newPassword" class="block text-sm font-medium text-gray-700">New Password</label>
                                    <input
                                        type="password"
                                        id="newPassword"
                                        wire:model="newPassword"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    >
                                    @error('newPassword') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="newPasswordConfirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                                    <input
                                        type="password"
                                        id="newPasswordConfirmation"
                                        wire:model="newPasswordConfirmation"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    >
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button
                                    type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                >
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @elseif(request()->routeIs('profile.orders'))
                <livewire:order-history />
            @endif
        </div>
    </div>
</div>