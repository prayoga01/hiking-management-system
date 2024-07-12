<table>
    <thead>
        <tr>
            <th colspan="3" rowspan="2"></th>
            <th colspan="5" style="text-align: center;"><strong>Mountaib List</strong></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th>No</th>
            <th>Mountain</th>
            <th>Location </th>
            <th>Content</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mountains as $mountain)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mountain->nm_mountain }}</td>
                <td>{{ $mountain->address_mountain }}</td>
                <td>{{ $mountain->content }}</td>
                <td>{{ $mountain->latitude }}</td>
                <td>{{ $mountain->longitude }}</td>
                <td>{{ $mountain->check_active }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
