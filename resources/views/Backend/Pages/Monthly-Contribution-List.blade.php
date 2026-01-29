@extends('Backend.Layout.MasterLayout')

@section('Content')

	<div class="card table-card shadow-sm my-3">
		<div class="card-header text-white text-center bg-success">
			<i class="fa-solid fa-hand-holding-dollar"></i> {{$committeeName}} মাসিক চাঁদা তালিকা
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table align-middle">
					<thead>
						<tr class="text-center">
							<th>ক্রমিক</th>
							<th>মাসের নাম</th>
							<th>পরিশোধের অবস্থা</th>
							<th>প্রদানের তারিখ</th>
							<th>অ্যাকশন</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($contributionList as $contribution)
							<tr class="text-center">
								<td data-label="ক্রমিক">@bn($loop->iteration + ($contributionList->currentPage() - 1) * $contributionList->perPage())</td>
								<td data-label="মাসের নাম">{{ $contribution->chadaName->chada_name }}</td>
								<td data-label="পরিশোধের অবস্থা">{{ $contribution->payment_status == 'paid' ? 'পরিশোধিত' : ($contribution->payment_status == 'not_paid' ? 'অপরিশোধিত' : 'অপেক্ষমাণ') }}</td>
								<td data-label="প্রদানের তারিখ">{{ $contribution->payment_date }}</td>
								<td data-label="অ্যাকশন">
									<div class="d-flex justify-content-center align-items-center gap-2">
										@php
											$userType = optional(Auth::user())->account_type;
											$status = $contribution->payment_status;
										@endphp

										@if($userType == 'admin')
											@switch($status)
												@case('paid')
													<span class="badge bg-success">অনুমোদিত</span>
													@break
												@case('pending')
													<span class="badge bg-warning text-dark">অপেক্ষমাণ</span>
													@break
												@case('not_paid')
													<span class="badge bg-secondary">অনুরোধ করা হয়নি</span>
													<button class="btn action-btn-warning" title="অনুরোধ পাঠান" data-bs-toggle="modal" data-bs-target="#requestModal{{ $contribution->id }}">
														<i class="fa-solid fa-paper-plane"></i>
													</button>
													@break
												@default
													<span class="badge bg-danger">বাতিল</span>
											@endswitch

										@elseif(in_array($userType, ['superadmin', 'cashier']))
											<button class="btn action-btn-info" title="বিস্তারিত দেখুন" data-bs-toggle="modal" data-bs-target="#viewFinanceModal{{ $contribution->id }}">
												<i class="fa-solid fa-eye"></i>
											</button>

											@switch($status)
												@case('paid')
													<span class="badge bg-success">পরিশোধিত</span>
													@break
												@case('pending')
													<button class="btn action-btn-success" title="অনুমোদন করুন" data-bs-toggle="modal" data-bs-target="#approveModal{{ $contribution->id }}">
														<i class="fa-solid fa-check"></i>
													</button>
													<button class="btn action-btn-danger" title="বাতিল করুন" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $contribution->id }}">
														<i class="fa-solid fa-xmark"></i>
													</button>
													@break
												@case('not_paid')
													<span class="badge bg-secondary">অনুরোধ করা হয়নি</span>
													@break
												@default
													<span class="badge bg-danger">বাতিল</span>
											@endswitch
										@endif
									</div>
								</td>
							</tr>

							<!-- View Modal -->
							<div class="modal fade" id="viewFinanceModal{{ $contribution->id }}" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header bg-primary text-white">
											<h6 class="modal-title">চাঁদার বিবরণ</h6>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<div class="modal-body">
											<p><strong>মাসের নাম:</strong> {{ $contribution->chadaName->chada_name }}</p>
											<p><strong>পরিশোধের পরিমাণ:</strong> {{ $contribution->amount }}</p>
											<p><strong>প্রদানের তারিখ:</strong> {{ $contribution->payment_date }}</p>
										</div>
										<div class="modal-footer">
											<button class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
										</div>
									</div>
								</div>
							</div>

							<!-- Approve Modal -->
							<div class="modal fade" id="approveModal{{ $contribution->id }}" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header bg-success text-white">
											<h6 class="modal-title">চাঁদা অনুমোদন</h6>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<form action="{{ route('contribution.approve', $contribution->id) }}" method="POST">
											@csrf
											@method('PATCH')

											<div class="modal-body text-center">
												<p>আপনি কি নিশ্চিত <strong>{{ $contribution->chadaName->chada_name }}</strong> এর চাঁদাটি অনুমোদন করতে চান?</p>
											</div>

											<div class="modal-footer justify-content-center">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">না</button>
												<button type="submit" class="btn btn-success">হ্যাঁ, অনুমোদন করুন</button>
											</div>
										</form>
									</div>
								</div>
							</div>

							<!-- Reject Modal -->
							<div class="modal fade" id="rejectModal{{ $contribution->id }}" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header bg-danger text-white">
											<h6 class="modal-title">চাঁদা বাতিল</h6>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<form action="{{ route('contribution.reject', $contribution->id) }}" method="POST">
											@csrf
											@method('PATCH')

											<div class="modal-body text-center">
												<p>আপনি কি নিশ্চিত <strong>{{ $contribution->chadaName->chada_name }}</strong> এর চাঁদাটি বাতিল করতে চান?</p>
											</div>
											<div class="modal-footer justify-content-center">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">না</button>
												<button type="submit" class="btn btn-danger">হ্যাঁ, বাতিল করুন</button>
											</div>
										</form>
									</div>
								</div>
							</div>

							<!-- Request Modal -->
							<div class="modal fade" id="requestModal{{ $contribution->id }}" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header bg-warning text-dark">
											<h6 class="modal-title">চাঁদার অনুরোধ</h6>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<form action="{{ route('contribution.request', $contribution->id) }}" method="POST">
											@csrf
											@method('PATCH')

											<div class="modal-body text-center">
												<p>আপনি কি নিশ্চিত <strong>{{ $contribution->chadaName->chada_name }}</strong> এর চাঁদা দেওয়ার পর অনুরোধটি পাঠাতে চাচ্ছেন?</p>
											</div>
											<div class="modal-footer justify-content-center">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
												<button type="submit" class="btn btn-warning text-dark">অনুরোধ করুন</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	{{$contributionList->links() }}

@endsection