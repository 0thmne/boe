<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Details - Pilot</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/details.css') }}">
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="{{ url('/demande') }}">
                <i class="fas fa-tasks"></i> Pilot
            </a>
        </div>
        <div class="user-profile">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <span>Admin</span>
        </div>
    </header>

    <div class="container">
        <a href="{{ url('admin/') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to list
        </a>

        <div class="detail-card">
            <div class="detail-header">
                <h1 class="detail-title">Request {{ $requestDetails->type }}</h1>
                <p class="detail-subtitle">{{ $requestDetails->uuid }}</p>
                <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $requestDetails->status)) }}">{{ $requestDetails->status }}</span>
            </div>
            <div class="detail-body">
                <div class="info-grid">
                    <div class="info-section">
                        <h3>Request Information</h3>
                        <div class="info-row">
                            <div class="info-label">ID:</div>
                            <div class="info-value">{{ $requestDetails->uuid }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Site:</div>
                            <div class="info-value">{{ $requestDetails->site }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Type:</div>
                            <div class="info-value">{{ $requestDetails->type }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Creation Date:</div>
                            <div class="info-value">{{ $requestDetails->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Deadline:</div>
                            <div class="info-value"></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">End Date:</div>
                            <div class="info-value">{{ $requestDetails->updated_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Status:</div>
                            <div class="info-value">{{ $requestDetails->status }}</div>
                        </div>

                    </div>

                    <div class="info-section">
                        <h3>Requester Information</h3>

                        <div class="info-row">
                            <div class="info-label">Last Name:</div>
                            <div class="info-value">{{ $requestDetails->surname }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">First Name:</div>
                            <div class="info-value">{{ $requestDetails->name }}</div>
                        </div>
                    </div>
                </div>

                <!-- New file download section -->
                <div class="file-download-section">
                    <h3 class="file-download-title">
                        <i class="fas fa-file-download"></i> Files
                    </h3>
                    @foreach (json_decode($requestDetails->file_client, true) as $file)
                    <div class="file-item">
                        <div class="file-info">
                            <div class="file-icon">
                                <i class="fas fa-file"></i>
                            </div>
                            <div>
                                <div class="file-name">{{ basename($file) }}</div>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $file) }}" class="download-btn" download="{{ basename($file) }}">
                            <i class="fas fa-download"></i> Download
                        </a>
                    </div>
                    @endforeach
                </div>

                <div class="action-buttons">
                    <a href="{{ url('/demande') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>