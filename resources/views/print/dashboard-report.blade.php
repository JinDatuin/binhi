<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Binhi Member Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        @page { margin: 1in; }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            padding: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #000;
        }
        .header h1 { font-size: 22px; text-transform: uppercase; letter-spacing: 2px; }
        .header p { font-size: 13px; margin-top: 5px; }
        .section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        .section h2 {
            font-size: 16px;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            margin-bottom: 12px;
        }
        .stats-grid {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }
        .stat-card {
            flex: 1;
            border: 1px solid #000;
            padding: 15px;
            text-align: center;
        }
        .stat-card .number { font-size: 28px; font-weight: bold; }
        .stat-card .label { font-size: 11px; text-transform: uppercase; margin-top: 5px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
            font-size: 11px;
        }
        th {
            background: #000;
            color: #fff;
            text-transform: uppercase;
            font-size: 10px;
        }
        .rankings-grid {
            display: flex;
            gap: 20px;
        }
        .rankings-grid > div {
            flex: 1;
            min-width: 0;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #000;
            font-size: 10px;
        }
        .controls {
            position: fixed;
            top: 10px;
            right: 10px;
            width: 260px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.15);
            z-index: 1000;
            font-family: system-ui, -apple-system, sans-serif;
            font-size: 13px;
        }
        .controls-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 14px;
            cursor: pointer;
            background: #f5f5f5;
            border-radius: 6px 6px 0 0;
            font-weight: 600;
            user-select: none;
        }
        .controls .toggle-icon {
            transition: transform 0.2s;
            font-size: 10px;
        }
        .controls.open .toggle-icon {
            transform: rotate(180deg);
        }
        .controls-body {
            display: none;
            padding: 8px 14px 14px;
            flex-direction: column;
            gap: 6px;
        }
        .controls.open .controls-body {
            display: flex;
        }
        .controls-body label {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            padding: 3px 0;
        }
        .controls-body input[type="checkbox"] {
            margin: 0;
            accent-color: #000;
        }
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="no-print controls">
        <div class="controls-header" onclick="this.parentElement.classList.toggle('open')">
            <span>Sections to Include</span>
            <span class="toggle-icon">&#9660;</span>
        </div>
        <div class="controls-body">
            <label><input type="checkbox" class="section-toggle" data-section="overview" checked> Membership Overview</label>
            <label><input type="checkbox" class="section-toggle" data-section="inside" checked> Inside San Carlos City</label>
            <label><input type="checkbox" class="section-toggle" data-section="outside" checked> Outside San Carlos City</label>
            <label><input type="checkbox" class="section-toggle" data-section="complete-list" checked> Complete List of Members</label>
            <label><input type="checkbox" class="section-toggle" data-section="attendance-ranking" checked> Attendance Ranking</label>
            <label><input type="checkbox" class="section-toggle" data-section="achievement-ranking" checked> Achievement Ranking</label>
        </div>
    </div>

    <div class="header">
        <h1>Binhi Members Report</h1>
        <p>Generated on: {{ now()->format('F j, Y \a\t g:i A') }}</p>
    </div>

    <div class="section" data-section="overview">
        <h2>Membership Overview</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="number">{{ $total }}</div>
                <div class="label">Total Members</div>
            </div>
            <div class="stat-card">
                <div class="number">{{ $male }}</div>
                <div class="label">Male</div>
            </div>
            <div class="stat-card">
                <div class="number">{{ $female }}</div>
                <div class="label">Female</div>
            </div>
        </div>
    </div>

    <div class="section" data-section="inside">
        <h2>Members Residing Inside San Carlos City</h2>
        <table>
            <thead>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inside as $i => $member)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $member->lastname }}, {{ $member->firstname }} {{ $member->middle_initial }}</td>
                    <td class="text-center">{{ $member->sex->getLabel() }}</td>
                    <td>{{ $member->barangay_name }}, {{ $member->municipality_name }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">No members found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section" data-section="outside">
        <h2>Members Residing Outside San Carlos City</h2>
        <table>
            <thead>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse($outside as $i => $member)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $member->lastname }}, {{ $member->firstname }} {{ $member->middle_initial }}</td>
                    <td class="text-center">{{ $member->sex->getLabel() }}</td>
                    <td>{{ $member->barangay_name }}, {{ $member->municipality_name }}{{ $member->province_name ? ', '.$member->province_name : '' }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">No members found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section" data-section="complete-list">
        <h2>Complete List of Binhi Members</h2>
        <table>
            <thead>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>Student No.</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Course</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>
                @forelse($allMembers as $i => $member)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $member->student_number }}</td>
                    <td>{{ $member->lastname }}, {{ $member->firstname }} {{ $member->middle_initial }}</td>
                    <td class="text-center">{{ $member->sex->getLabel() }}</td>
                    <td>{{ $member->course }}</td>
                    <td class="text-center">{{ $member->year->getLabel() }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">No members found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section rankings-section" data-section="rankings">
        <h2 class="rankings-heading">Rankings</h2>
        <div class="rankings-grid">
            <div data-section="attendance-ranking">
                <h3>Attendance Ranking</h3>
                <table>
                    <thead>
                        <tr>
                            <th style="width:40px;">Rank</th>
                            <th>Name</th>
                            <th class="text-center">Present</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendanceRanking as $i => $member)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $member->lastname }}, {{ $member->firstname }} {{ $member->middle_initial }}</td>
                            <td class="text-center">{{ $member->attendances_count }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center">No records.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div data-section="achievement-ranking">
                <h3>Achievement Ranking</h3>
                <table>
                    <thead>
                        <tr>
                            <th style="width:40px;">Rank</th>
                            <th>Name</th>
                            <th class="text-center">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($achievementRanking as $i => $member)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $member->lastname }}, {{ $member->firstname }} {{ $member->middle_initial }}</td>
                            <td class="text-center">{{ number_format($member->achievement_points, 2) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center">No records.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="footer">
        Binhi Organization &mdash; Official Dashboard Report
    </div>

    <div class="no-print" style="text-align:center;margin-top:20px;">
        <button onclick="window.print()" style="padding:10px 30px;font-size:14px;cursor:pointer;">Print</button>
        <button onclick="window.close()" style="padding:10px 30px;font-size:14px;cursor:pointer;">Close</button>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var toggles = document.querySelectorAll('.section-toggle');
    var rankingsSection = document.querySelector('.rankings-section');
    var rankingsHeading = document.querySelector('.rankings-heading');

    // Restore saved state
    var saved = localStorage.getItem('printSectionToggles');
    if (saved) {
        try {
            var parsed = JSON.parse(saved);
            toggles.forEach(function (cb) {
                var section = cb.getAttribute('data-section');
                if (parsed[section] !== undefined) {
                    cb.checked = parsed[section];
                }
            });
        } catch (e) {}
    }

    function applyToggles() {
        toggles.forEach(function (cb) {
            var section = cb.getAttribute('data-section');
            var els = document.querySelectorAll('[data-section="' + section + '"]');
            els.forEach(function (el) {
                el.style.display = cb.checked ? '' : 'none';
            });
        });

        // Save state
        var state = {};
        toggles.forEach(function (cb) {
            state[cb.getAttribute('data-section')] = cb.checked;
        });
        localStorage.setItem('printSectionToggles', JSON.stringify(state));

        // Show rankings heading only if at least one ranking is visible
        if (rankingsSection) {
            var attVis = document.querySelector('[data-section="attendance-ranking"]').style.display !== 'none';
            var achVis = document.querySelector('[data-section="achievement-ranking"]').style.display !== 'none';
            if (!attVis && !achVis) {
                rankingsSection.style.display = 'none';
            } else {
                rankingsSection.style.display = '';
                if (rankingsHeading) {
                    rankingsHeading.style.display = attVis && achVis ? '' : 'none';
                }
            }
        }
    }

    toggles.forEach(function (cb) {
        cb.addEventListener('change', applyToggles);
    });

    applyToggles();
});
</script>

</body>
</html>
