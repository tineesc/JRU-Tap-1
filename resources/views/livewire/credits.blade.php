<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-transparent dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">

            <!-- Main Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 rounded shadow-md mb-3">
                <!-- Top-Up Credits Form -->
                <div class="bg-purple-50">
                    <!-- Content -->
                    <form action="{{ route('pay') }}">
                        <h2 class="font-semibold text-3xl text-center text-slate-600 py-5 mx-auto">Top up Credits</h2>
                        <div class="mx-6 py-2">
                            <x-label for="credits" value="{{ __('Credits') }}" />
                            <x-input wire:model="credits" id="credits" class="block mt-1 w-full md:w-92 mx-auto"
                                type="text" name="credits" :value="old('credits')" required autofocus
                                autocomplete="credits" placeholder="amount" required {{-- Numbers only Validation --}}
                                oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />

                        </div>
                        <div class="mx-6 py-2">
                            <x-label for="cardID" value="{{ __('Card ID Number') }}" />
                            <x-input wire:model="cardID" id="cardID" class="block mt-1 w-full md:w-92 mx-auto"
                                type="text" name="cardID" :value="old('cardID')" required autofocus autocomplete="cardID"
                                placeholder="Card ID Number" required {{-- Numbers only Validation --}}
                                oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
                        </div>

                        <div class="py-5 mx-5 text-center">
                            <x-button>Pay Card</x-button>
                        </div>
                    </form>
                </div>

                <!-- Balance Credits -->
                <div class="grid place-content-center bg-purple-50 text-center">
                    <form action="">
                        <!-- Content -->
                        <h2 class="font-semibold text-2xl  text-slate-600 py-2">Balance Credits</h2>
                        <p class="font-bold text-xl">
                            @if (Auth::user()->card_amount)
                                {{ Auth::user()->card_amount }}a
                            @else
                                No Balance to show
                            @endif
                        </p>
                        <div class="py-5 mx-5 text-center">
                            <x-button>Register Card</x-button>
                        </div>
                    </form>
                </div>

                <!-- Driver Wallet Balance (Only for Role 4) -->
                @role(4)
                    <div class="grid place-content-center bg-purple-50 text-center">
                        <form>
                            <!-- Content -->
                            <h2 class="font-semibold text-2xl  text-slate-600 py-2">Driver Wallet Balance</h2>
                            <p class="font-bold text-xl">
                                @if (Auth::user()->wallet_amount)
                                    {{ Auth::user()->wallet_amount }}
                                @else
                                    No Balance to show
                                @endif
                            </p>
                            <div class="py-5 mx-5 text-center">
                                <x-button>Send</x-button>
                                <x-button>Withdraw</x-button>
                            </div>
                        </form>
                    </div>
                @endrole
            </div>

            <!-- Virtual Card Section -->
            <div class="bg-sky-600 p-5">
                <!-- Content -->
                <h2 class="font-semibold text-2xl">Virtual Card</h2>
                <h2 class="font-semibold text-2xl">Modern Jeepney (ACTONA)</h2>
                <div class="pt-16 pb-10 flex flex-col md:flex-row justify-between items-center">
                    <img src="/image/chip.png" alt="" class="max-w-full h-10 md:w-32 md:h-16 mb-4 md:mb-0" />
                    <h2 class="font-semibold text-2xl">{{ Auth::user()->name }}</h2>
                </div>
                <div class="flex justify-between">
                    <p class="text-3xl pt-6 font-bold" id="myText">
                        @if (Auth::user()->card_id)
                            {{ Auth::user()->card_id }}
                        @else
                            No Register Card ID
                        @endif
                    </p>
                    <button id="copy-button" class="onclick:text-red-200 rounded-md text-white p-2 mt-2 z-10"
                        onclick="copyContent()">Copy to Clipboard</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let text = document.getElementById('myText').innerHTML;
        const copyContent = async () => {
            try {
                await navigator.clipboard.writeText(text);
                console.log('Content copied to clipboard');

                // Change the button text to indicate success
                document.getElementById('copy-button').textContent = 'Copied!';

                // Revert the button text to its original state after 3 seconds
                setTimeout(() => {
                    document.getElementById('copy-button').textContent = 'Copy to Clipboard';
                }, 3000); // 3000 milliseconds = 3 seconds
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        }
    </script>
