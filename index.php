<!doctype html>
<html lang='en'>
	<head>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link
			href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css'
			rel='stylesheet'
			integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3'
			crossorigin='anonymous' />
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
		<title>Instructors' Availability</title>
	</head>
	<body>
		<h1 class='display-6' style='text-align: center'>Instructors' Availability</h1>
		<div class='container'>
			<div class='row'>
				<div class='col'></div>
				<div class='col-6'>
					<table class='table'>
						<thead>
							<tr>
								<th scope='col' class='text-center'>#</th>
								<th scope='col' class='text-center'>Name</th>
								<th scope='col' class='text-center'>Availability</th>
							</tr>
						</thead>
						<tbody data-bind="template: { foreach: instructors }">
							<tr>
								<th scope='row' class='text-center' data-bind="text: index"></th>
								<td data-bind="text: name"></td>
								<td class='text-center'>
									<a role="button" class="btn btn-success btn-sm" style="width: 7em; min-width: 7em; max-width: 7em;" data-bind="
										css: {
											'btn-success': available,
											'btn-action-join': available,
											'btn-danger': !available,
											'disabled': !available,
										},
										attr: {
											href: available ? meetingRoomUrl : 'javascript:void(0);',
											'data-index': index,
											target: available ? '_blank' : 'none'
										},
										text: available ? 'AVAILABLE' : 'BUSY'
									"></a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class='col'></div>
			</div>
		</div>
	</body>
	<script
		src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js'
		integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p'
		crossorigin='anonymous'></script>
	<script
		src='https://code.jquery.com/jquery-3.6.0.min.js'
		integrity='sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4='
		crossorigin='anonymous'></script>
	<script type='text/javascript'
		src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.0/knockout-min.js"></script>
	<script type='text/javascript'>
		function InstructorViewModel() {
			var self = this;

			self.instructors = ko.observableArray([]);
		}

		function fetchData(viewModel) {
			$.ajax({
				type: 'GET',
				url: 'inst_avail_read.php',
				success: (data) => {
					viewModel.instructors(JSON.parse(data));
				},
				error: (jqXHR, status, error) => {
					console.log(error);
				}
			});
		}

		function toggleUnavailable(index, viewModel) {
			$.ajax({
				type: 'POST',
				url: `inst_mark_unavail.php?index=${index}&status=0`,
				success: (data) => {
					console.log(data);
				},
				error: (jqXHR, status, error) => {
					console.log(error);
				}
			});
		}

		$(document).ready(() => {
			var viewModel = new InstructorViewModel();
			
			ko.applyBindings(viewModel);

			fetchData(viewModel);

			setInterval(() => {
				fetchData(viewModel);
			}, 2000);

			$(document).on("click", "a.btn-action-join", (e) => {
				const $elem = $(e.target);
				toggleUnavailable($elem.attr("data-index"), viewModel);
			});
		});
	</script>
</html>