php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: #2a2a2a url('https://wiki.teamfortress.com/w/images/thumb/7/79/Pyro_Armageddon_Taunt.png/225px-Pyro_Armageddon_Taunt.png') no-repeat bottom right fixed;
            font-family: 'TF2 Build', 'Space Mono', monospace;
            color: #E6E6E6;
        }

        .dashboard-container {
            padding: 2rem;
            background: rgba(0, 0, 0, 0.85);
            min-height: 100vh;
            border: 2px solid #4D4D4D;
        }

        .stats-card {
            background: rgba(42, 42, 42, 0.9);
            border: 2px solid #ff3d00;
            border-radius: 0;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .stats-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, #ff3d00, transparent);
        }

        .stats-card h4 {
            color: #ff3d00;
            text-transform: uppercase;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .stats-card h2 {
            color: #E6E6E6;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .nav-tabs {
            border: none;
            margin-bottom: 20px;
            display: flex;
            background: rgba(0,0,0,0.5);
            padding: 10px;
        }

        .nav-tabs .nav-link {
            color: #E6E6E6;
            background: none;
            border: 2px solid transparent;
            text-transform: uppercase;
            font-weight: bold;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link.active {
            background: #ff3d00;
            border-color: #ff3d00;
            color: #fff;
        }

        .nav-tabs .nav-link:hover {
            border-color: #ff3d00;
            color: #ff3d00;
        }

        .report-card {
            background: rgba(42, 42, 42, 0.9);
            border: 1px solid #4D4D4D;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .report-card:hover {
            background: rgba(255, 61, 0, 0.1);
            border-color: #ff3d00;
        }

        .table-dark {
            background: rgba(42, 42, 42, 0.9);
            border: 2px solid #4D4D4D;
        }

        .table-dark th {
            background: #ff3d00;
            color: #fff;
            text-transform: uppercase;
            border: none;
        }

        .table-dark td {
            border-color: #4D4D4D;
        }

        h1 {
            font-size: 3rem;
            color: #E6E6E6;
            text-transform: uppercase;
            text-shadow: 3px 3px 0 #ff3d00;
            margin-bottom: 2rem;
            font-weight: bold;
        }

        .btn-approve, .btn-reject {
            font-family: 'TF2 Build', 'Space Mono', monospace;
            text-transform: uppercase;
            padding: 10px 20px;
            font-weight: bold;
            letter-spacing: 1px;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-approve {
            background: #ff3d00;
            color: #fff;
        }

        .btn-reject {
            background: #4D4D4D;
            color: #E6E6E6;
        }

        .btn-approve:hover, .btn-reject:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(255, 61, 0, 0.5);
        }

        .pending-badge {
            background: #ff3d00;
            padding: 2px 8px;
            border-radius: 0;
            font-weight: bold;
            animation: pulse 2s infinite;
        }

        /* TF2-style selection indicator */
        .nav-item {
            position: relative;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: -20px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            border-left: 8px solid #ff3d00;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .nav-item:hover::before,
        .nav-item .nav-link.active + ::before {
            opacity: 1;
            left: -10px;
        }

        /* Class icon style boxes for stats */
        .stats-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 2rem;
        }

        .stat-box {
            width: 150px;
            height: 150px;
            background: rgba(0,0,0,0.5);
            border: 2px solid #4D4D4D;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .stat-box:hover {
            border-color: #ff3d00;
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <audio id="pyroThankSound" style="display: none;">
        <source src="https://wiki.teamfortress.com/w/images/4/47/Pyro_thanks01.wav" type="audio/wav">
    </audio>
    <audio id="victorySound" style="display: none;">
        <source src="https://wiki.teamfortress.com/w/images/9/93/Your_team_won.wav" type="audio/wav">
    </audio>
    <button id="playSound" class="btn btn-link text-warning" style="position: fixed; top: 10px; right: 100px;">
        <i class="fas fa-volume-up"></i> Play Victory Sound
    </button>

    <div class="dashboard-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-terminal mr-2"></i>Admin Dashboard</h1>
            <a href="<?= base_url('supersecret/logout') ?>" class="btn btn-danger">
                <i class="fas fa-power-off mr-2"></i>Logout
            </a>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="stats-card">
                    <h4><i class="fas fa-users mr-2"></i>Total Users</h4>
                    <h2><?= $total_users ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <h4><i class="fas fa-file-alt mr-2"></i>Pending Reports</h4>
                    <h2><?= is_array($pending_reports) ? count($pending_reports) : 0 ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <h4><i class="fas fa-check-circle mr-2"></i>Approved Reports</h4>
                    <h2><?= is_array($approved_reports) ? count($approved_reports) : 0 ?></h2>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs mt-4 mb-4">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#pending">
                    <i class="fas fa-clock mr-2"></i>Pending Reports
                    <?php if(is_array($pending_reports) && count($pending_reports) > 0): ?>
                        <span class="pending-badge"><?= count($pending_reports) ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#approved">
                    <i class="fas fa-check-circle mr-2"></i>Approved Reports
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#users">
                    <i class="fas fa-users mr-2"></i>User Management
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="pending">
                <div class="pending-reports mt-4">
                    <h3>Pending Reports</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Pet Name</th>
                                    <th>Reporter</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pending_reports as $report): ?>
                                <tr>
                                    <td><?= $report['formatted_date'] ?></td>
                                    <td><?= $report['tipe_laporan'] ?></td>
                                    <td><?= $report['nama_hewan'] ?></td>
                                    <td><?= $report['nama_pelapor'] ?></td>
                                    <td><?= $report['lokasi_terakhir'] ?></td>
                                    <td>
                                        <button class="btn btn-success btn-sm approve-btn" 
                                                data-id="<?= $report['id_laporan'] ?>">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                        <button class="btn btn-danger btn-sm reject-btn"
                                                data-id="<?= $report['id_laporan'] ?>">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="approved">
                <div class="approved-reports mt-4">
                    <h3>Approved Reports</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Pet Name</th>
                                    <th>Reporter</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($approved_reports as $report): ?>
                                <tr>
                                    <td><?= $report['formatted_date'] ?></td>
                                    <td><?= $report['tipe_laporan'] ?></td>
                                    <td><?= $report['nama_hewan'] ?></td>
                                    <td><?= $report['nama_pelapor'] ?></td>
                                    <td><?= $report['lokasi_terakhir'] ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm reject-btn" 
                                                data-id="<?= $report['id_laporan'] ?>">
                                            <i class="fas fa-times"></i> Mark as Pending
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="users">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($users) && is_array($users)): ?>
                                <?php foreach($users as $user): ?>
                                    <tr>
                                        <td><?= esc($user['nama']) ?></td>
                                        <td><?= esc($user['email']) ?></td>
                                        <td><?= esc($user['nomor_telepon']) ?></td>
                                        <td><span class="badge badge-success">Active</span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No users found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Play victory sound on dashboard load
            const victorySound = document.getElementById('victorySound');
            victorySound.volume = 0.5;
            victorySound.play().catch(function(error) {
                console.log("Audio autoplay failed:", error);
            });
        });

        document.getElementById('playSound').addEventListener('click', function() {
            document.getElementById('victorySound').play();
        });

        $(document).ready(function() {
            // Update existing click handler to handle both approve and reject buttons
            $('.approve-btn, .reject-btn').click(function() {
                const button = $(this);
                const id = button.data('id');
                const status = button.hasClass('approve-btn') ? 'yes' : 'no';
                const confirmMessage = status === 'yes' ? 
                    'Are you sure you want to approve this report?' : 
                    'Are you sure you want to mark this report as pending?';
                
                if (confirm(confirmMessage)) {
                    $.ajax({
                        url: '<?= base_url('admin/updateReportStatus') ?>/' + id,
                        type: 'POST',
                        data: {
                            status: status
                        },
                        success: function(response) {
                            if (response.success) {
                                // Play Pyro thanks sound only for approvals
                                if (status === 'yes') {
                                    document.getElementById('pyroThankSound').play();
                                }
                                
                                // Remove the row with animation and reload
                                button.closest('tr').fadeOut(400, function() {
                                    $(this).remove();
                                    location.reload();
                                });
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Failed to update status');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>