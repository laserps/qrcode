<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Question</th>
        <th>Answer</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
        @php
        $i = 0;
        @endphp
        @foreach($data as $k => $v)
            <tr>
                <td>{{++$k}}</td>
                @if($v->q_id != $i)
                @php
                $i = $v->q_id;
                @endphp
                <td>{{strip_tags($v->q_text)}}</td>
                @else
                <td></td>
                @endif
                <td>{{strip_tags($v->a_text)}}</td>
                <td>{{$v->ans_count}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
