<x-layout>
    <x-breadcrumbs
        class='mb-4'
        :links="['Jobs' => route('jobs.index'), $job->title => '#']" />
    <x-job-card :$job>
        <p class='mb-4 text-sm text-slate-500'>{!! nl2br(e($job->description)) !!}</p>

        @if (auth()->user())
            @can('apply', $job)
                <x-link-button :href="route('jobs.application.create', $job)">Apply</x-link-button>
            @else
                <div class="text-center text-sm text-slate-500 font-medium">
                    You already applied for this job
                </div>
            @endcan
        @else
            <x-link-button :href="route('auth.create')" class="w-full">Login to apply</x-link-button>
        @endif
    </x-job-card>

    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            More {{ $job->employer->company_name }} Jobs
        </h2>

        <div class="text-sm text-slate-500">
            @foreach ($job->employer->jobs as $otherJob)
                <div class="flex mb-4 justify-between">
                    <div>
                        <div class="text-slate-700">
                            <a href="{{ route('jobs.show', $otherJob) }}">{{ $otherJob->title }}</a>
                        </div>
                        <div class="text-xs">{{ $otherJob->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="text-xs">${{ number_format($otherJob->salary) }}</div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>