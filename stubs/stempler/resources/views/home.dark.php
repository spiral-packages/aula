<extends:auth.layouts.app/>

<block:content>
    <nav class="bg-white border-b border-gray-200 fixed z-30 w-full">
        <div class="px-4 py-4 lg:px-5 lg:pl-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start"></div>
                <div class="flex items-center">
                    @if(isset($user->email))
                        <div class="pr-5">
                            {{ json_encode($user) }}
                        </div>
                        <form action="/logout" method="POST">
                            <button class="text-cyan-600 background-transparent font-bold uppercase px-3 py-1 text-xs outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="submit">
                                Logout
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</block:content>
