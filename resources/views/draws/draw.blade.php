@extends('layouts.app')

@section('content')

	<div id="app1" class="content">
		<el-card class="card" >
			<div class="input-wrapper">
				<div class="title" for="prizes">Prize types</div>
				<el-select v-model="prizeType" name="prizes" placeholder="-----Select one-----" class="input-control">
					<el-option
					v-for="item in options"
					:key="item.value"
					:label="item.label"
					:value="item.value">
				</el-option>
			</el-select>
		</div>
		<div class="input-wrapper">
			<el-checkbox v-model="random" class="input-control"><b>Tick for generate winner randomly.</b></el-checkbox>
		</div>
		<div class="input-wrapper">
			<div class="title">Winning number</div>
			<el-input v-model="winning_number" :disabled="random == true" class="input-control">
			</div>
			<el-button class="text-right" type="default" @click="draw_winner()">Draw</el-button>
		</el-card>	
	</div>
@endsection
@section('script')
	<script>
		new Vue({
			el: '#app1',
			data: function() {
				return { 
					options: [
					{
						value: "3.1",
						label: "Third prize - 1st winnie"
					},
					{
						value: "3.2",
						label: "Third prize - 2nd winnie"
					},
					{
						value: "3.3",
						label: "Third prize - 3rd winnie"
					},
					{
						value: "2.1",
						label: "Second prize - 1st winnie"
					},
					{
						value: "2.2",
						label: "Second prize - 2nd winnie"
					},
					{
						value: "1",
						label: "First prize"
					}
					],
					prizeType: null,
					random: false,
					winning_number: ''
				}
			},
			watch: {
				random: function() {
					if(this.random == true) {
						this.winning_number = '';
					}
				}
			},
			methods: {
				draw_winner(){

					if( this.prizeType == null ) {

						this.$message.error("Prize type is required.");
						return false;

					}

					axios.post('draw/winner', {
						prizeType: this.prizeType,
						random: this.random,
						winning_number: this.winning_number
					})
					.then(response => {
						console.log(response.data);
						if(response.data.status == true) {

							var prizeType = '';

							switch(this.prizeType) {
								case '1':
								prizeType = "First Prize"
								break;
								case '2.1':
								prizeType = "Second Prize"
								break;
								case '2.2':
								prizeType = "Second Prize"
								break;
								case '3.1':
								prizeType = "Third Prize"
								break;
								case '3.2':
								prizeType = "Third Prize"
								break;
								case '3.3':
								prizeType = "Third Prize"
								break;
							}

							this.$alert('<strong>Congratez to '+response.data.data.name+'. You got the '+prizeType+'.</strong>', response.data.message, {
								dangerouslyUseHTMLString: true,
								confirmButtonText: "Done"
							});

							return true;

						} else {
							this.$message.error(response.data.message);
							return false;
						}
					})
					.catch(e => {
						this.$message.error("Error found.");
						return false;
					})
				}
			}
		})
	</script>

@endsection