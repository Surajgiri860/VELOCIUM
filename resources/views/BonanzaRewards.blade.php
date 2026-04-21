{{-- BonanzaRewards.blade.php --}}
@include('includes.header')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">🏆 Bonanza Rewards</h4>
                        <p class="category">Track your rank progress and claim rewards</p>
                    </div>
                    <div class="card-body">
                        {{-- Debug: Check if data exists --}}
                        @php
                            if(isset($rewards)) {
                                echo "<!-- Debug: Found " . count($rewards) . " rewards -->";
                            } else {
                                echo "<!-- Debug: No rewards variable passed -->";
                            }
                        @endphp
                        
                        @if(isset($rewards) && count($rewards) > 0)
                            <div class="alert alert-success">
                                <i class="fa fa-check-circle"></i> Found {{ count($rewards) }} rewards! Complete your business targets to claim them.
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-triangle"></i> No rewards found. Please contact administrator.
                            </div>
                        @endif

                        {{-- Current Rank & Business Summary Cards --}}
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="card text-white bg-primary">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <h5 class="card-title">Current Rank</h5>
                                                <h2 class="mb-0">{{ $currentRank ?? 'No Rank' }}</h2>
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="fa fa-trophy fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-success">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <h5 class="card-title">Direct Business</h5>
                                                <h2 class="mb-0">${{ number_format($totalDirectBusiness ?? 0, 2) }}</h2>
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="fa fa-users fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <h5 class="card-title">Team Business</h5>
                                                <h2 class="mb-0">${{ number_format($totalTeamBusiness ?? 0, 2) }}</h2>
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="fa fa-sitemap fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        {{-- Progress Bar for Next Rank --}}
                        @php
                            $nextReward = null;
                            $currentDirect = $totalDirectBusiness ?? 0;
                            $currentTeam = $totalTeamBusiness ?? 0;
                            
                            foreach($rewards as $reward) {
                                if($currentDirect < $reward->direct_required || $currentTeam < $reward->team_required) {
                                    $nextReward = $reward;
                                    break;
                                }
                            }
                        @endphp

                        @if($nextReward)
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Next Rank: {{ $nextReward->rank_name }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Direct Business Progress: ${{ number_format($currentDirect, 2) }} / ${{ number_format($nextReward->direct_required, 2) }}</label>
                                                    <div class="progress">
                                                        @php
                                                            $directPercent = min(100, ($currentDirect / $nextReward->direct_required) * 100);
                                                        @endphp
                                                        <div class="progress-bar bg-success" style="width: {{ $directPercent }}%" role="progressbar">
                                                            {{ round($directPercent) }}%
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Team Business Progress: ${{ number_format($currentTeam, 2) }} / ${{ number_format($nextReward->team_required, 2) }}</label>
                                                    <div class="progress">
                                                        @php
                                                            $teamPercent = min(100, ($currentTeam / $nextReward->team_required) * 100);
                                                        @endphp
                                                        <div class="progress-bar bg-info" style="width: {{ $teamPercent }}%" role="progressbar">
                                                            {{ round($teamPercent) }}%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <small class="text-muted">Next Reward: {{ $nextReward->reward_name }} - ${{ number_format($nextReward->reward_amount, 2) }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Rewards Table --}}
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">📋 Available Bonanza Rewards</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="bonanzaTable">
                                                <thead>
                                                    <tr>
                                                        <th>Rank Name</th>
                                                        <th>Direct Required ($)</th>
                                                        <th>Team Required ($)</th>
                                                        <th>Reward Name</th>
                                                        <th>Reward Amount ($)</th>
                                                        <th>Your Direct</th>
                                                        <th>Your Team</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($rewards as $reward)
                                                        @php
                                                            $userDirect = $totalDirectBusiness ?? 0;
                                                            $userTeam = $totalTeamBusiness ?? 0;
                                                            $isDirectAchieved = $userDirect >= $reward->direct_required;
                                                            $isTeamAchieved = $userTeam >= $reward->team_required;
                                                            $isAchieved = $isDirectAchieved && $isTeamAchieved;
                                                            $isClaimed = isset($claimedRewards[$reward->id]);
                                                            
                                                            // Calculate percentages for visual indicators
                                                            $directPercent = min(100, ($userDirect / $reward->direct_required) * 100);
                                                            $teamPercent = min(100, ($userTeam / $reward->team_required) * 100);
                                                        @endphp
                                                        <tr>
                                                            <td><strong>{{ $reward->rank_name }}</strong></td>
                                                            <td>${{ number_format($reward->direct_required, 2) }}</td>
                                                            <td>${{ number_format($reward->team_required, 2) }}</td>
                                                            <td>{{ $reward->reward_name }}</td>
                                                            <td class="text-success"><strong>${{ number_format($reward->reward_amount, 2) }}</strong></td>
                                                            <td>
                                                                <div class="progress" style="height: 20px;">
                                                                    <div class="progress-bar {{ $isDirectAchieved ? 'bg-success' : 'bg-warning' }}" 
                                                                         style="width: {{ $directPercent }}%">
                                                                        ${{ number_format($userDirect, 0) }}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="progress" style="height: 20px;">
                                                                    <div class="progress-bar {{ $isTeamAchieved ? 'bg-success' : 'bg-warning' }}" 
                                                                         style="width: {{ $teamPercent }}%">
                                                                        ${{ number_format($userTeam, 0) }}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                @if($isClaimed)
                                                                    <span class="badge badge-success" style="padding: 8px 12px;">
                                                                        <i class="fa fa-check-circle"></i> Claimed
                                                                    </span>
                                                                @elseif($isAchieved)
                                                                    <span class="badge badge-primary" style="padding: 8px 12px;">
                                                                        <i class="fa fa-unlock-alt"></i> Eligible
                                                                    </span>
                                                                @else
                                                                    <span class="badge badge-secondary" style="padding: 8px 12px;">
                                                                        <i class="fa fa-lock"></i> Locked
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($isAchieved && !$isClaimed)
                                                                    <form action="{{ route('bonanza.claim', $reward->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to claim this reward?');">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-success btn-sm">
                                                                            <i class="fa fa-gift"></i> Claim Reward
                                                                        </button>
                                                                    </form>
                                                                @elseif($isClaimed)
                                                                    <button class="btn btn-secondary btn-sm" disabled>
                                                                        <i class="fa fa-check"></i> Already Claimed
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-secondary btn-sm" disabled>
                                                                        <i class="fa fa-lock"></i> Not Available
                                                                    </button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="9" class="text-center">
                                                                <div class="alert alert-warning mb-0">
                                                                    <i class="fa fa-exclamation-triangle"></i> No rewards configured. Please contact administrator.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Claimed Rewards History Section --}}
                        @if(isset($claimedRewards) && count($claimedRewards) > 0)
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">📜 Claimed Rewards History</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Rank Name</th>
                                                            <th>Reward Name</th>
                                                            <th>Amount</th>
                                                            <th>Claimed Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $history = \App\Models\RankRewardHistory::where('user_id', Auth::id())
                                                                        ->where('status', 'claimed')
                                                                        ->with('reward')
                                                                        ->orderBy('created_at', 'desc')
                                                                        ->get();
                                                        @endphp
                                                        @foreach($history as $item)
                                                            <tr>
                                                                <td>{{ $item->rank_name }}</td>
                                                                <td>{{ $item->reward_name }}</td>
                                                                <td class="text-success">${{ number_format($item->amount, 2) }}</td>
                                                                <td>{{ $item->created_at->format('d M Y, h:i A') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')

<script>
    $(document).ready(function() {
        // Initialize DataTable if jQuery and DataTable are loaded
        if ($.fn.DataTable) {
            $('#bonanzaTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "responsive": true,
                "pageLength": 10,
                "language": {
                    "search": "Search:",
                    "lengthMenu": "Show _MENU_ entries",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries"
                }
            });
        } else {
            console.log("DataTable not loaded");
        }
    });
</script>

<style>
    .progress {
        background-color: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
    }
    .progress-bar {
        line-height: 20px;
        color: white;
        font-size: 11px;
        font-weight: bold;
    }
    .badge {
        font-size: 12px;
    }
    .card {
        margin-bottom: 20px;
    }
    .table th {
        background-color: #f8f9fa;
    }
    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
    }
</style>

@if(session('success'))
<script>
    alert("✓ {{ session('success') }}");
</script>
@endif

@if(session('error'))
<script>
    alert("✗ {{ session('error') }}");
</script>
@endif