<x-app-layout>
    <x-slot name="title">
        Detail Proyek
    </x-slot>


    <nav class="bg-white border-gray-200 ">
        <div class="flex flex-wrap items-center justify-between p-4 mx-auto">
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 "
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg md:p-0 bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white ">
                    @if (Auth::user()->role === 'edit')
                        <li>
                            <a href="#"
                                class="block px-3 py-2 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 "
                                aria-current="page">Gantt Chart</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 ">Sumber Daya</a>
                        </li>

                        <li>
                            <a href="#"
                                class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 ">Setting</a>
                        </li>
                    @elseif (Auth::user()->role === 'view')
                        <li>
                            <a href="#"
                                class="block px-3 py-2 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 "
                                aria-current="page">Gantt Chart</a>
                        </li>
                        <!-- User view tidak melihat Sumber Daya dan Setting -->
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if (Auth::user()->role === 'edit')
    <div class="mb-4">
        <a href="{{ route('proyek.edit', $project->id) }}" class="btn btn-primary">Edit Proyek</a>
        <a href="{{ route('proyek.updateStatus', $project->id) }}" class="btn btn-success">Ubah Status</a>
    </div>
    @endif

    @if (Auth::user()->role === 'view')
    <div class="mb-4">
        <p>Anda hanya memiliki akses untuk melihat proyek ini.</p>
    </div>
    @endif

    <div id="gantt_here" style="width:100%; height:500px;"></div>
    <script type="text/javascript">
        gantt.config.date_format = "%Y-%m-%d %H:%i:%s";

        gantt.init("gantt_here");

        gantt.load("/api/data/{{ $project->id }}");


        var dp = new gantt.dataProcessor("/api");
        dp.init(gantt);
        dp.setTransactionMode("REST", true); // Menggunakan mode REST dengan JSON
        console.log("Gantt data load URL:", "/api/data/{{ $project->id }}");

        @if (Auth::user()->role === 'view')
            gantt.config.readonly = true; // Membuat Gantt Chart hanya baca untuk User View
        @endif


        dp.attachEvent("onBeforeUpdate", function(id, task, action) {
            action.project_id = {{ $project->id }};
            console.log(action)

            return action;
        });
    </script>
</x-app-layout>
