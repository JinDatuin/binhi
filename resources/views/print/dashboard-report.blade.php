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
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Binhi Members Report</h1>
        <p>Generated on: {{ now()->format('F j, Y \a\t g:i A') }}</p>
    </div>

    <div class="section">
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

    <div class="section">
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

    <div class="section">
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

    <div class="section">
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

    <div class="section">
        <h2>Rankings</h2>
        <div class="rankings-grid">
            <div>
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
            <div>
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

</body>
</html>
