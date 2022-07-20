<extends:auth.layouts.app/>

<block:content>
    <div class="mx-auto md:h-screen flex flex-col justify-center items-center px-6 pt-8 pt:mt-0">
        <div class="bg-white shadow rounded-lg md:mt-0 w-full sm:max-w-screen-sm xl:p-0">
            <div class="p-6 sm:p-8 lg:p-16 space-y-8">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900">
                    Sign in to platform
                </h2>
                <form class="mt-8 space-y-6" action="/login" method="POST">
                    @isset($errors)
                        @foreach($errors as $error)
                            <div class="p-2 rounded-sm bg-red-600 text-white w-full">{{ $error['error'] }}</div>
                        @endforeach
                    @endisset
                    @isset($registered)
                        <div class="p-2 rounded-sm bg-green-600 text-white w-full">{{ $registered }}</div>
                    @endisset
                    <div>
                        <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="name@company.com" required>
                    </div>
                    <div>
                        <label for="password" class="text-sm font-medium text-gray-900 block mb-2">Your password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required>
                    </div>
                    <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-base px-5 py-3 w-full sm:w-auto text-center">Login to your account</button>
                    <div class="text-sm font-medium text-gray-500">
                        Not registered? <a href="/register" class="text-teal-500 hover:underline">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</block:content>
