<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Request Management Platform</title>
    <link rel="stylesheet" href="{{ asset('css/follow.css') }}">
</head>
<body>
    <div class="success-message" id="success-message">
        Your request has been created successfully
    </div>
    
    <div class="container">
        <div class="main-content">
            <div class="content">
                <h1 class="h1">Your Request</h1>
                <div class="card-container">
                    <div class="card">
                        <span class="status-badge">{{ $requestDetails->status }}</span>
                        <div class="request-id-below-badge">#{{ $requestDetails->uuid }}</div>
                        <div class="card-header">
                            <div class="client-flow">
                                <div class="client">
                                    <div class="client-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="person-name">{{ $requestDetails->name }} {{ $requestDetails->surname }}</div>
                                        <div class="assigned-person">
                                            <i class="fas fa-arrow-right"></i>
                                            @if($requestDetails->assigned_to && $requestDetails->assignedAgent)
                                                {{ $requestDetails->assignedAgent->surname }} {{ $requestDetails->assignedAgent->name }}
                                            @else
                                                {{ __('app.not_assigned') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="request-details">
                                <h3>Details</h3>
                                <div class="detail">
                                    <span class="detail-icon">
                                        <i class="fas fa-tag"></i>
                                    </span>
                                    {{ $requestDetails->type }}
                                </div>
                                <div class="detail">
                                    <span class="detail-icon">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    Created on: {{ $requestDetails->created_at ? $requestDetails->created_at->format('m/d/Y') : 'N/A' }}
                                </div>
                                <div class="detail">
                                    <span class="detail-icon">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                    Deadline: {{ $requestDetails->deadline ? $requestDetails->deadline->format('m/d/Y') : 'N/A' }}
                                </div>
                            </div>
                        </div>
                        <!-- File download section -->
                        <div class="file-download-section">
                            <h3 class="file-download-title">
                                <i class="fas fa-file-download"></i> File
                            </h3>
                            <div class="file-item">
                                <div class="file-info">
                                    <div class="file-icon">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div class="file-name">{{ $requestDetails->file_name }}</div>
                                </div>
                                <a href="{{ asset('storage/' . $requestDetails->file_path) }}" class="download-btn">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Display success message when the page loads
        window.onload = function() {
            // Hide success message after 5 seconds
            setTimeout(function() {
                const successMessage = document.getElementById('success-message');
                successMessage.addEventListener('animationend', function() {
                    this.style.display = 'none';
                });
            }, 5000);
            
            // Manage display of download sections and apply appropriate colors based on status
            const cards = document.querySelectorAll('.card');
            
            cards.forEach(card => {
                const statusBadge = card.querySelector('.status-badge');
                const fileDownloadSection = card.querySelector('.file-download-section');
                
                if (statusBadge) {
                    const status = statusBadge.textContent.trim().toLowerCase();
                    
                    // Apply appropriate class and styling based on status
                    if (status === 'completed') {
                        // Green for completed
                        card.classList.add('completed');
                        statusBadge.classList.add('completed');
                        statusBadge.style.backgroundColor = 'rgba(46, 125, 50, 0.1)';
                        statusBadge.style.color = '#2e7d32'; // Green color
                        card.style.borderLeftColor = '#2e7d32';
                        
                        // Show file download section for completed status
                        if (fileDownloadSection) {
                            fileDownloadSection.style.display = 'block';
                        }
                    } else if (status === 'new') {
                        // Blue for new
                        card.classList.add('new');
                        statusBadge.classList.add('new');
                        statusBadge.style.backgroundColor = 'rgba(33, 150, 243, 0.1)';
                        statusBadge.style.color = '#2196f3'; // Blue color
                        card.style.borderLeftColor = '#2196f3';
                        
                        // Hide file download section
                        if (fileDownloadSection) {
                            fileDownloadSection.style.display = 'none';
                        }
                    } else if (status === 'in progress') {
                        // Orange for in progress
                        card.classList.add('in-progress');
                        statusBadge.classList.add('in-progress');
                        statusBadge.style.backgroundColor = 'rgba(245, 124, 0, 0.1)';
                        statusBadge.style.color = '#f57c00'; // Orange color
                        card.style.borderLeftColor = '#f57c00';
                        
                        // Hide file download section
                        if (fileDownloadSection) {
                            fileDownloadSection.style.display = 'none';
                        }
                    }
                }
            });
        };
    </script>
</body>
</html>