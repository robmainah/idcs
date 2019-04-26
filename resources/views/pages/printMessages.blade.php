<html>
	<head>
		<title>IDCS</title>
		<style type="text/css">
			table {
				width: 100%;
				font-family: Helvetica, Arial, Sans-serif;
				/*border: 1px solid black;*/
				border-collapse: collapse;
			}
			td {
				padding: 5px;
				border: 1px solid black;
				font-size: 13px;
			}
			th {
				padding: 10px;
				border: 1px solid black;
				background-color: #54bbc8cc;
			}
			.st {
				padding: 10px;
			}
			table tr:nth-of-type(2n+2)
			{
				background-color: #e6e6e6;
			}
		</style>
	</head>

	<body>
		<h2 style="text-align: center;text-transform: uppercase;">jocham hospital</h2>
		<h4>Message's Report</h4>
		<table>
			<thead>
			    <tr>
			        <th style="width: 5%"></th>
			        <th>Text</th>
			        <th style="width: 15%">From</th>
			        <th style="width: 15%">To</th>
			        <th style="width: 15%">Date</th>
			    </tr>
			</thead>
			<tbody>
			    <?php $no = 1; ?>
			    @foreach($messagesTo as $value)
				    <tr id="{{ $value->id }}">
				        <!--<td id="td_one" class="fi_ltassel">-->
				        <td style="width: 5%"> {{$no}} </td>
				        <td>{{ ucfirst($value->text) }}</td>
				        <td>
				        	@if($value->from_user_id == auth()->id())
				        		<span>me</span>
				        	@else
				        		{{ ucFirst($value->fromUser['name']) }}
				        	@endif
				        </td>
				        <td>
				        	@if($value->to_user_id == auth()->id())
				        		<span>me</span>
				        	@else
				        		{{ ucFirst($value->toUser['name']) }}
				        	@endif
				        </td>
				        <td>{{ date("F d, Y", strtotime($value->created_at)) }}</td>
				    </tr>
			    	<?php $no++ ?>
			    @endforeach
			</tbody>
		</table>
	</body>
</html>