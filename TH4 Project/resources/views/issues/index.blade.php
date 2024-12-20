<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bài tập thực hành 4</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Liên kết Bootstrap JS -->
<script>
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>
<style>
.table-title .btn {
	color: #fff;
	float: right;
	font-size: 13px;
	border: none;
	min-width: 50px;
	border-radius: 2px;
	border: none;
	outline: none !important;
	margin-left: 10px;
}
table {
      width: 100%;
      border-collapse: collapse; /* Đảm bảo không có khoảng cách giữa các ô */
    }

    td, th {
      border: 1px solid black; /* Kẻ đường viền cho các ô */
      padding: 8px;
    }
  </style>
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-primary-subtle">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Trình quản lý sự cố</a>
    <div class="collapse navbar-collapse" id="navbarNav">
    </div>
	<div class="table-title">
				<div class="row">
					<div class="col mb-1 mt-2">
						<a href="{{ route('issues.create') }}" class="btn btn-success">Thêm lỗi mới</a>
					</div>
				</div>
			</div>
  </div>
</nav>
<div class="container mt-2">
	<div class="table-responsive">
		<div class="table-wrapper">
			@if(session('success'))
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
			@endif
			<table class="table table-striped table-hover border border-black">
				<thead>
					<tr>
						<th>Mã vấn đề</th>
						<th>Tên máy tính</th>
						<th>Phiên bản</th>
						<th>Người báo cáo sự cố</th>
						<th>Thời gian báo cáo</th>
						<th>Mức độ sự cố</th>
						<th>Trạng thái hiện tại</th>
						<th>Hành động</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($issues as $issue)
						<tr>
							<td>{{ $issue->id }}</td>
							<td>{{ $issue->computer->computer_name }}</td>
							<td>{{ $issue->computer->model}}</td>
							<td>{{ $issue->reported_by }}</td>
							<td>{{ $issue->reported_date }}</td>
							<td>{{ $issue->urgency }}</td>
							<td>{{ $issue->status }}</td>
							<td>
								<a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-primary">Edit</a>
								
								<!-- Delete Button with Confirmation Modal -->
								<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $issue->id }}">
									Delete
								</button>

								<!-- Delete Confirmation Modal -->
								<div class="modal fade" id="deleteModal{{ $issue->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $issue->id }}" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="deleteModalLabel{{ $issue->id }}">Xác nhận xóa</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												Bạn có muốn xóa sự cố này ?
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
												<form action="{{ route('issues.destroy', $issue->id) }}" method="POST" style="display:inline;">
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-danger">Xóa</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{-- Pagination --}}
			<div class="d-flex justify-content-center">
				{{ $issues->links('pagination::bootstrap-5') }}
			</div>
		</div>
	</div>        
</div>

</body>
</html>
