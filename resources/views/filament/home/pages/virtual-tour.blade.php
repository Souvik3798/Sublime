<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="h-48 overflow-hidden">
                <img class="w-full h-full object-cover"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Front_View_of_Cellular_Jail%2C_Port_Blair.JPG/640px-Front_View_of_Cellular_Jail%2C_Port_Blair.JPG"
                    alt="Cellular Jail">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold">Cellular Jail</h3>
                <p class="text-gray-600 mt-2 text-justify">To enhance the experience, we propose the integration of a
                    virtual tour of
                    the Cellular Jail, complete with the inclusion of AI-driven characters. This immersive experience
                    will faithfully replicate the actual wings of the historic site, allowing users to explore its
                    corridors and cells in a detailed and engaging manner. The addition of AI characters will further
                    enrich the experience by providing interactive storytelling, historical insights, and personalized
                    narratives, making the virtual visit both informative and memorable. </p>
            </div>
            <div class="px-4 py-3 bg-gray-100 flex justify-end">
                <x-filament::button
                    @click="window.open('{{ url('https://www.vrkshetra.com/historical-journey/cultural-heritage/cellular-jail') }}', '_blank')">
                    View
                </x-filament::button>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="h-48 overflow-hidden">
                <img class="w-full h-full object-cover"
                    src="https://www.saevus.in/wp-content/uploads/2021/05/PHOTO-1-scaled.jpg" alt="Barren Island">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold">Barren Island</h3>
                <p class="text-gray-600 mt-2 text-justify">A virtual tour of Barren Island offers an extraordinary
                    journey to one of the most remote and enigmatic places on Earth. Located in the Andaman Sea, Barren
                    Island is home to the only active volcano in South Asia, surrounded by the deep blue waters of the
                    Indian Ocean. This immersive virtual experience allows you to explore the island's rugged
                    landscapes, witness the smoking volcanic crater, and marvel at the stark contrast between the
                    island's desolate terrain and the vibrant marine life that thrives in the surrounding coral reefs.
                </p>
            </div>
            <div class="px-4 py-3 bg-gray-100 flex justify-end">
                <x-filament::button>
                    View
                </x-filament::button>
            </div>
        </div>

    </div>
</x-filament-panels::page>
