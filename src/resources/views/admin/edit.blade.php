<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Request - Pilot</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="{{ url('/admin') }}">
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
        
        <div class="form-card">
            <div class="form-header">
                <h2>Edit Request</h2>
                <span class="form-header-id">{{ $requestDetails->uuid }}</span>
            </div>
            <div class="form-body">
                <span class="form-status status-{{ strtolower(str_replace(' ', '-', $requestDetails->status)) }}">{{ $requestDetails->status }}</span>

                <div class="demand-details">
                    <div class="demand-detail">
                        <span class="demand-detail-label">Assigned to</span>
                        <span>{{ $requestDetails->assigned_to ? $requestDetails->assignedTo->surname . ' ' . $requestDetails->assignedTo->name : 'Not assigned' }}</span>
                    </div>
                    <div class="demand-detail">
                        <span class="demand-detail-label">Type</span>
                        <span>{{ $requestDetails->type }}</span>
                    </div>
                    <div class="demand-detail">
                        <span class="demand-detail-label">Creation Date:</span>
                        <span>{{ \Carbon\Carbon::parse($requestDetails->created_at)->format('d/m/Y') }}</span>
                    </div>
                </div>

                <div class="status-change">
                    <button class="status-btn status-btn-new {{ $requestDetails->status == 'New' ? 'active' : '' }}">New</button>
                    <button class="status-btn status-btn-progress {{ $requestDetails->status == 'In Progress' ? 'active' : '' }}">In Progress</button>
                    <button class="status-btn status-btn-completed {{ $requestDetails->status == 'Completed' ? 'active' : '' }}">Completed</button>
                </div>

                <form id="editForm" action="{{ route('edit.update', $requestDetails->uuid) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" id="status" value="{{ $requestDetails->status }}">
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="assignedTo">Assigned to</label>
                                <select class="form-control" id="assignedTo" name="assigned_to">
                                    @if(!$requestDetails->assigned_to)
                                        <option value="">Select an agent</option>
                                    @endif
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}" {{ $requestDetails->assigned_to == $agent->id ? 'selected' : '' }}>{{ $agent->surname }} {{ $agent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="dueDate">Due date</label>
                                <input type="date" class="form-control" id="dueDate" name="due_date" value="{{ $requestDetails->due_date ? \Carbon\Carbon::parse($requestDetails->due_date)->format('Y-m-d') : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="description">Request description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ $requestDetails->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="comments">Comments</label>
                        <textarea class="form-control" id="comments" name="comments" rows="3" placeholder="Add comments or notes about the request...">{{ $requestDetails->comments }}</textarea>
                    </div>

                    <div class="form-footer">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Handle status change buttons
        const statusButtons = document.querySelectorAll('.status-btn');
        statusButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                statusButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                // Update status input value
                document.getElementById('status').value = this.textContent.trim();
                
                // Update status display
                const formStatus = document.querySelector('.form-status');
                formStatus.className = 'form-status';
                
                if (this.classList.contains('status-btn-new')) {
                    formStatus.classList.add('status-new');
                    formStatus.textContent = 'New';
                } else if (this.classList.contains('status-btn-progress')) {
                    formStatus.classList.add('status-progress');
                    formStatus.textContent = 'In Progress';
                } else if (this.classList.contains('status-btn-completed')) {
                    formStatus.classList.add('status-completed');
                    formStatus.textContent = 'Completed';
                }
            });
        });
    </script>
</body>
</html>