@extends('layouts.app')

@section('content')
    <!-- Stats -->
    <div class="shadow-base-300/10 rounded-box bg-base-100 flex gap-4 p-6 shadow-md max-xl:flex-col">
        <div class="flex flex-1 gap-4 max-sm:flex-col">
            <div class="flex flex-1 flex-col gap-4">
                <div class="text-base-content flex items-center gap-2">
                    <div class="avatar avatar-placeholder">
                        <div class="bg-base-200 rounded-field size-9">
                            <span class="icon-[tabler--eye] size-5"></span>
                        </div>
                    </div>
                    <h5 class="text-lg font-medium">Pageviews</h5>
                </div>
                <div>
                    <div class="text-base-content text-xl font-semibold">17,356</div>
                    <div class="flex items-center gap-2 text-sm font-semibold">
                        <span class="text-success inline-flex items-center gap-1">
                            <span class="icon-[tabler--arrow-up] size-4"></span>
                            25.6%
                        </span>
                        <span class="text-base-content/50 font-medium">EPC: 308.20</span>
                    </div>
                </div>
            </div>
            <div class="divider sm:divider-horizontal"></div>
            <div class="flex flex-1 flex-col gap-4">
                <div class="text-base-content flex items-center gap-2">
                    <div class="avatar avatar-placeholder">
                        <div class="bg-base-200 rounded-field size-9">
                            <span class="icon-[tabler--mouse] size-6"></span>
                        </div>
                    </div>
                    <h5 class="text-lg font-medium">Click</h5>
                </div>
                <div>
                    <div class="text-base-content text-xl font-semibold">2,784</div>
                    <div class="flex items-center gap-2 text-sm font-semibold">
                        <span class="text-error inline-flex items-center gap-1">
                            <span class="icon-[tabler--arrow-down] size-4"></span>
                            25.6%
                        </span>
                        <span class="text-base-content/50 font-medium">Related Value: 77,359</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider xl:divider-horizontal"></div>
        <div class="flex flex-1 gap-4 max-sm:flex-col">
            <div class="flex flex-1 flex-col gap-4">
                <div class="text-base-content flex items-center gap-2">
                    <div class="avatar avatar-placeholder">
                        <div class="bg-base-200 rounded-field size-9">
                            <span class="icon-[tabler--chart-bar] size-6"></span>
                        </div>
                    </div>
                    <h5 class="text-lg font-medium">Commission</h5>
                </div>
                <div>
                    <div class="text-base-content text-xl font-semibold">$1,658</div>
                    <div class="flex items-center gap-2 text-sm font-semibold">
                        <span class="text-success inline-flex items-center gap-1">
                            <span class="icon-[tabler--arrow-up] size-4"></span>
                            25.6%
                        </span>
                        <span class="text-base-content/50 font-medium">Related Value: 77,359</span>
                    </div>
                </div>
            </div>
            <div class="divider sm:divider-horizontal"></div>
            <div class="flex flex-1 flex-col gap-4">
                <div class="text-base-content flex items-center gap-2">
                    <div class="avatar avatar-placeholder">
                        <div class="bg-base-200 rounded-field size-9">
                            <span class="icon-[tabler--currency-dollar] size-6"></span>
                        </div>
                    </div>
                    <h5 class="text-lg font-medium">Sales</h5>
                </div>
                <div>
                    <div class="text-base-content text-xl font-semibold">$8,759</div>
                    <div class="flex items-center gap-2 text-sm font-semibold">
                        <span class="text-success inline-flex items-center gap-1">
                            <span class="icon-[tabler--arrow-up] size-4"></span>
                            25.6%
                        </span>
                        <span class="text-base-content/50 font-medium">Related Value: 13.85</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
