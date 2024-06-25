<x-app-layout>
    <div class="bg-white p-14 container mx-auto mt-16">
        <h1 class="text-2xl font-extrabold">كتاب: {{$book->title}}</h1>
        <div class="flex flex-col mt-6">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table
                            class="min-w-full border border-neutral-200 text-center text-sm font-light text-surface dark:border-white/10 dark:text-white">
                            <tbody>
                            <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td
                                    class="whitespace-nowrap border-e border-neutral-200 px-6 py-4 font-medium dark:border-white/10">
                                    1
                                </td>
                                <td
                                    class="whitespace-nowrap border-e border-neutral-200 px-6 py-4 dark:border-white/10">
                                    Mark
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
