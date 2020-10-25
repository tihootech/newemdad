<div class="d-flex justify-content-center">
	<div class="rahgiri">
		<b> کد رهگیری شما </b>
		<hr>
		<p class="m-0 p-0">
			@foreach ( str_split($apply->uid) as $i => $char)
				@if ($i)
					<b class="text-danger"> - </b>
				@endif
				<span class="rahgiri-char"> {{$char}} </span>
			@endforeach
		</p>
	</div>
</div>
