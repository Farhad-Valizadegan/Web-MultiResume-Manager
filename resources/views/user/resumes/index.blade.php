<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div><h2 class="text-2xl font-bold text-ink">My resumes</h2><p class="text-sm text-muted mt-2">A focused resume for every opportunity. Manage your drafts and shared links here.</p></div>
            <a href="{{ route('user.resumes.create') }}" class="rf-button rf-button-primary">Create resume <span aria-hidden="true">+</span></a>
        </div>
    </x-slot>
    <div class="py-8 sm:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))<p role="status" class="bg-green-soft text-green-strong border border-green-soft rounded-xl p-4">{{ session('success') }}</p>@endif
            <p data-copy-message hidden role="status" aria-live="polite" class="bg-blue-soft text-blue-strong border border-blue-soft rounded-xl p-4"></p>
            @if($resumes->count())
                <div class="rf-list-toolbar">
                    <label class="flex-1"><span class="rf-label">Find a resume</span><input type="search" data-resume-search placeholder="Search by title or job position" class="w-full"></label>
                    <label><span class="rf-label">Status</span><select data-resume-status class="w-full"><option value="all">All statuses</option><option value="active">Active</option><option value="inactive">Inactive</option></select></label>
                </div>
                <p data-resume-results role="status" aria-live="polite" class="text-sm text-muted"></p>
            @endif
            <div class="rf-resume-grid">
                @forelse($resumes as $resume)
                    @php($publicUrl = route('public.resume.password', $resume->public_link))
                    <article data-resume-card data-search="{{ $resume->title }} {{ $resume->job_position }}" data-status="{{ $resume->status }}" class="rf-resume-card">
                        <div class="flex flex-wrap items-center gap-2 mb-4">
                            <span class="rf-badge {{ $resume->status === 'active' ? 'bg-green-soft text-green-strong' : 'bg-surface-soft text-muted' }}">{{ $resume->status === 'active' ? 'Active' : 'Inactive' }}</span>
                            <span class="rf-badge bg-surface-soft text-muted">{{ $resume->resume_password_hash ? 'Password protected' : 'Public access' }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-ink break-words">{{ $resume->title }}</h3>
                        <p class="text-muted mt-2 break-words">{{ $resume->job_position ?: 'Add a target position to make this resume easier to identify.' }}</p>
                        <dl class="rf-resume-meta">
                            <div><dt>Total views</dt><dd>{{ number_format($resume->view_count ?? 0) }}</dd></div>
                            <div><dt>Last viewed</dt><dd>{{ $resume->last_viewed_at ? $resume->last_viewed_at->diffForHumans() : 'Not yet viewed' }}</dd></div>
                        </dl>
                        <div class="flex flex-wrap gap-3 mt-5">
                            <a href="{{ route('user.resumes.edit', $resume) }}" class="rf-button rf-button-primary" aria-label="Edit {{ $resume->title }}">Edit resume</a>
                            <a href="{{ $publicUrl }}" target="_blank" rel="noopener" class="rf-button rf-button-secondary" aria-label="View {{ $resume->title }} in a new tab">View public resume <span aria-hidden="true">↗</span></a>
                        </div>
                        <details class="rf-resume-details">
                            <summary>Sharing &amp; settings</summary>
                            <div class="rf-resume-details-content">
                                @if($resume->status !== 'active')<p class="text-sm text-muted">This resume is inactive. Activate it in the editor before sharing its public link.</p>@endif
                                <label><span class="rf-label">Public link</span><input type="text" value="{{ $publicUrl }}" readonly class="w-full text-sm" onclick="this.select()"></label>
                                <button type="button" data-copy-link="{{ $publicUrl }}" class="rf-button rf-button-secondary">Copy link</button>
                                <div class="rf-setting-row"><div><p class="font-semibold text-sm">Access protection</p><p class="text-sm text-muted mt-1">{{ $resume->resume_password_hash ? 'Visitors need your resume password.' : 'Anyone with the link can view this active resume.' }}</p></div><a href="{{ route('user.resumes.password', $resume) }}" class="rf-button rf-button-secondary">{{ $resume->resume_password_hash ? 'Change password' : 'Set password' }}</a></div>
                                <div><p class="font-semibold text-sm">Downloads</p><p class="text-sm text-muted mt-1">{{ ['generated' => 'Generated resume PDF', 'uploaded' => 'Uploaded resume PDF', 'both' => 'Generated and uploaded PDFs'][$resume->download_resume_type] ?? 'No download option selected' }}. Change this in the resume editor.</p></div>
                                <div class="rf-setting-row rf-danger-row"><p class="text-sm text-muted">Deleting this resume also removes its files and shared link.</p><form action="{{ route('user.resumes.destroy', $resume) }}" method="POST" onsubmit="return confirm('Delete this resume and its files? This cannot be undone.');">@csrf @method('DELETE')<button type="submit" class="rf-button rf-button-danger">Delete resume</button></form></div>
                            </div>
                        </details>
                    </article>
                @empty
                    <div class="rf-empty-state"><span class="rf-empty-icon" aria-hidden="true">+</span><h3 class="text-2xl font-bold">Your next opportunity starts here</h3><p class="text-muted mt-3 mb-6">Create your first resume, then choose how to share it.</p><a href="{{ route('user.resumes.create') }}" class="rf-button rf-button-primary">Create your first resume</a></div>
                @endforelse
            </div>
            <div data-resume-empty hidden class="rf-empty-state"><h3 class="text-lg font-semibold">No matching resumes</h3><p class="text-muted mt-2 mb-4">Try a different title or clear the status filter.</p><button type="button" data-reset-filters class="rf-button rf-button-secondary">Clear filters</button></div>
        </div>
    </div>
</x-app-layout>
