<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ ($resume->full_name ?: $resume->title) }} - Resume</title>

    <style>
        @page {
            margin: 24px 28px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1f2937;
            font-size: 11.5px;
            line-height: 1.45;
            margin: 0;
            padding: 0;
            background: #ffffff;
        }

        h1, h2, h3, p {
            margin: 0;
            padding: 0;
        }

        .header {
            background: #111827;
            color: #ffffff;
            padding: 18px 20px;
            border-radius: 10px;
            margin-bottom: 16px;
        }

        .name {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .job-title {
            font-size: 14px;
            color: #dbeafe;
            margin-bottom: 10px;
        }

        .contact {
            font-size: 10.5px;
            color: #e5e7eb;
            line-height: 1.55;
        }

        .contact-item {
            margin-bottom: 2px;
        }

        .section {
            margin-top: 14px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 15px;
            font-weight: bold;
            color: #1e40af;
            border-bottom: 1.5px solid #93c5fd;
            padding-bottom: 4px;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .section-box {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 10px 12px;
            background: #f9fafb;
            margin-bottom: 8px;
            page-break-inside: avoid;
        }

        .item {
            margin-bottom: 10px;
            page-break-inside: avoid;
        }

        .item:last-child {
            margin-bottom: 0;
        }

        .item-title {
            font-size: 13px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 2px;
        }

        .item-subtitle {
            font-size: 11.5px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 2px;
        }

        .muted {
            color: #6b7280;
            font-size: 10.5px;
            margin-bottom: 3px;
        }

        .text {
            color: #374151;
            font-size: 11.2px;
        }

        .link {
            color: #1d4ed8;
            font-size: 10.5px;
            word-break: break-all;
        }

        .badge {
            display: inline-block;
            background: #dbeafe;
            color: #1e3a8a;
            border: 1px solid #bfdbfe;
            padding: 3px 7px;
            border-radius: 10px;
            margin: 2px 3px 2px 0;
            font-size: 10.5px;
            font-weight: bold;
        }

        .language-badge {
            display: inline-block;
            background: #f3e8ff;
            color: #6b21a8;
            border: 1px solid #e9d5ff;
            padding: 3px 7px;
            border-radius: 10px;
            margin: 2px 4px 2px 0;
            font-size: 10.5px;
            font-weight: bold;
        }

        .interest-badge {
            display: inline-block;
            background: #ccfbf1;
            color: #115e59;
            border: 1px solid #99f6e4;
            padding: 3px 7px;
            border-radius: 10px;
            margin: 2px 4px 2px 0;
            font-size: 10.5px;
            font-weight: bold;
        }

        .two-column-table {
            width: 100%;
            border-collapse: collapse;
        }

        .two-column-table td {
            width: 50%;
            vertical-align: top;
            padding-right: 8px;
        }

        .footer {
            margin-top: 18px;
            padding-top: 8px;
            border-top: 1px solid #d1d5db;
            font-size: 9.5px;
            color: #6b7280;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <div class="name">
            {{ ($resume->full_name ?: $resume->title) }}
        </div>

        <div class="job-title">
            {{ $resume->job_position ?? $resume->title }}
        </div>

        <div class="contact">
            <div class="contact-item">
                Email: {{ $resume->email }}
            </div>

            @if ($resume->phone)
                <div class="contact-item">
                    Phone: {{ $resume->phone }}
                </div>
            @endif

            @if ($resume->address)
                <div class="contact-item">
                    Location: {{ $resume->address }}
                </div>
            @endif

            @if ($resume->website)
                <div class="contact-item">
                    Website: {{ $resume->website }}
                </div>
            @endif

            @if ($resume->linkedin)
                <div class="contact-item">
                    LinkedIn: {{ $resume->linkedin }}
                </div>
            @endif

            @if ($resume->github)
                <div class="contact-item">
                    GitHub: {{ $resume->github }}
                </div>
            @endif


        </div>
    </div>

    <!-- Professional Summary -->
    <div class="section">
        <div class="section-title">
            Professional Summary
        </div>

        <div class="section-box">
            <p class="text">
                {{ $resume->title }}
            </p>

            @if ($resume->professional_summary)
                <p class="text" style="margin-top: 6px;">
                    {{ $resume->professional_summary }}
                </p>
            @endif
        </div>
    </div>

    <!-- Skills -->
    @if ($resume->skills->count())
        <div class="section">
            <div class="section-title">
                Skills
            </div>

            @php
                $groupedSkills = $resume->skills->groupBy(function ($skill) {
                    return $skill->skill_category ?: 'Other Skills';
                });
            @endphp

            @foreach ($groupedSkills as $category => $skills)
                <div class="section-box">
                    <div class="item-title">
                        {{ $category }}
                    </div>

                    @foreach ($skills as $skill)
                        <span class="badge">
                            {{ $skill->skill_name }}
                            @if ($skill->skill_level)
                                - {{ $skill->skill_level }}
                            @endif
                            @if($skill->evidence_url)<a href="{{ $skill->evidence_url }}">{{ $skill->evidence_label ?: 'View evidence' }}</a>@endif
                        </span>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif

    <!-- Languages -->
    @if ($resume->languages->count())
        <div class="section">
            <div class="section-title">
                Languages
            </div>

            <div class="section-box">
                @foreach ($resume->languages as $language)
                    <span class="language-badge">
                        {{ $language->language_name }}
                        @if ($language->proficiency_level)
                            - {{ $language->proficiency_level }}
                        @endif
                    </span>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Professional Experience -->
    @if ($resume->experiences->count())
        <div class="section">
            <div class="section-title">
                Professional Experience
            </div>

            @foreach ($resume->experiences as $experience)
                <div class="section-box">
                    @if ($experience->job_title)
                        <div class="item-title">
                            {{ $experience->job_title }}
                        </div>
                    @endif

                    @if ($experience->company_name)
                        <div class="item-subtitle">
                            {{ $experience->company_name }}
                        </div>
                    @endif

                    @if ($experience->start_date || $experience->end_date)
                        <div class="muted">
                            @if ($experience->start_date && $experience->end_date)
                                {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - {{ \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                            @elseif ($experience->start_date && !$experience->end_date)
                                {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - Present
                            @elseif (!$experience->start_date && $experience->end_date)
                                Until {{ \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                            @endif
                        </div>
                    @endif

                    @if ($experience->description)
                        <p class="text">
                            {{ $experience->description }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- Education -->
    @if ($resume->educations->count())
        <div class="section">
            <div class="section-title">
                Education
            </div>

            @foreach ($resume->educations as $education)
                <div class="section-box">
                    @if ($education->institution_name)
                        <div class="item-title">
                            {{ $education->institution_name }}
                        </div>
                    @endif

                    @if ($education->degree || $education->field_of_study)
                        <div class="item-subtitle">
                            @if ($education->degree)
                                {{ $education->degree }}
                            @endif

                            @if ($education->degree && $education->field_of_study)
                                -
                            @endif

                            @if ($education->field_of_study)
                                {{ $education->field_of_study }}
                            @endif
                        </div>
                    @endif

                    @if ($education->start_date || $education->end_date)
                        <div class="muted">
                            @if ($education->start_date && $education->end_date)
                                {{ \Carbon\Carbon::parse($education->start_date)->format('M Y') }} - {{ \Carbon\Carbon::parse($education->end_date)->format('M Y') }}
                            @elseif ($education->start_date && !$education->end_date)
                                {{ \Carbon\Carbon::parse($education->start_date)->format('M Y') }} - Present
                            @elseif (!$education->start_date && $education->end_date)
                                Until {{ \Carbon\Carbon::parse($education->end_date)->format('M Y') }}
                            @endif
                        </div>
                    @endif

                    @if ($education->description)
                        <p class="text">
                            {{ $education->description }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- Licenses & Certifications -->
    @if ($resume->certificates->count())
        <div class="section">
            <div class="section-title">
                Licenses & Certifications
            </div>

            @foreach ($resume->certificates as $certificate)
                <div class="section-box">
                    @if ($certificate->certificate_title)
                        <div class="item-title">
                            {{ $certificate->certificate_title }}
                        </div>
                    @endif

                    @if ($certificate->issuer)
                        <div class="item-subtitle">
                            {{ $certificate->issuer }}
                        </div>
                    @endif

                    @if ($certificate->issue_date)
                        <div class="muted">
                            Issued: {{ \Carbon\Carbon::parse($certificate->issue_date)->format('M Y') }}
                        </div>
                    @endif

                    @if ($certificate->credential_id)
                        <div class="muted">
                            Credential ID: {{ $certificate->credential_id }}
                        </div>
                    @endif

                    @if ($certificate->credential_url)
                        <p class="link">
                            {{ $certificate->credential_url }}
                        </p>
                    @endif

                    @if ($certificate->description)
                        <p class="text">
                            {{ $certificate->description }}
                        </p>
                    @endif

                    @if ($certificate->related_project_title)
                        <p class="text" style="margin-top: 4px;">
                            Related Project:
                            {{ $certificate->related_project_title }}
                        </p>
                    @endif

                    @if ($certificate->related_project_link)
                        <p class="link">
                            {{ $certificate->related_project_link }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- Projects -->
    @if ($resume->projects->count())
        <div class="section">
            <div class="section-title">
                Projects
            </div>

            @foreach ($resume->projects as $project)
                <div class="section-box">
                    @if ($project->project_title)
                        <div class="item-title">
                            {{ $project->project_title }}
                        </div>
                    @endif

                    @if ($project->project_description)
                        <p class="text">
                            {{ $project->project_description }}
                        </p>
                    @endif

                    @if ($project->project_link)
                        <p class="link">
                            <a href="{{ $project->project_link }}">{{ $project->project_link_label ?: 'View Project' }}</a>
                        </p>
                    @endif
                    @if ($project->demo_url)
                        <p class="link"><a href="{{ $project->demo_url }}">{{ $project->demo_label ?: 'Watch demo' }}</a></p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- Hobbies & Interests -->
    @if ($resume->interests->count())
        <div class="section">
            <div class="section-title">
                Hobbies & Interests
            </div>

            <div class="section-box">
                @foreach ($resume->interests as $interest)
                    <div class="item">
                        @if ($interest->interest_name)
                            <span class="interest-badge">
                                {{ $interest->interest_name }}
                            </span>
                        @endif

                        @if ($interest->description)
                            <p class="text" style="margin-top: 4px;">
                                {{ $interest->description }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="footer">
        Generated by Online Resume Management System
    </div>

</body>
</html>