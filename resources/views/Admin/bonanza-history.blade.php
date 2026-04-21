@include('layouts.header')

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Rank</th>
            <th>Reward</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($claims as $claim)
        <tr>
            <td>{{ $claim->id }}</td>
            <td>{{ $claim->user->name ?? 'N/A' }}</td>
            <td>{{ $claim->rank_name }}</td>
            <td>{{ $claim->reward_name }}</td>
            <td>${{ $claim->amount }}</td>

            <td>
                @if($claim->status == 0)
                    <span class="badge badge-warning">Pending</span>
                @else
                    <span class="badge badge-success">Released</span>
                @endif
            </td>

            <td>
                @if($claim->status == 0)
                    <a href="{{ route('admin.bonanza.release', $claim->id) }}" 
                       class="btn btn-success btn-sm"
                       onclick="return confirm('Release this reward?')">
                       Release
                    </a>
                @else
                    <span class="text-success">Done</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $claims->links() }}
@include('layouts.footer')
