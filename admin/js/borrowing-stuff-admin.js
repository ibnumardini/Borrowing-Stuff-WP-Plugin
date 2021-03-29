jQuery(document).ready(function ($) {
	$(".btn-edit-borrowing").on("click", function (e) {

		e.preventDefault();

		let postdata = $("#edit_borrowing").serialize();
		postdata += "&action=admin_ajax_requests&param=store_borrowing"

		$.post(ajaxurl, postdata, function (res) {

			resParse = JSON.parse(res)

			if (resParse.status) {
				$(".alert-borrowing-success").show()

				setTimeout(function () {
					$(".alert-borrowing-success").hide()
					$("#card-edit-borrowing").hide()
				}, 3000)

			} else {
				$(".alert-borrowing-danger").show()

				setTimeout(function () {
					$(".alert-borrowing-danger").hide()
				}, 3000)
			}
		})
	})

	$(".btn-edit-stuff").on("click", function () {
		id = $(this).data('id')

		$.ajax({
			url: ajaxurl,
			type: 'post',
			dataType: 'json',
			data: {
				id: id,
				action: 'admin_ajax_requests',
				param: 'edit_stuff'
			},
			success: (res) => {

				$("#edit-stuff-title").text("Edit : " + res.name)
				$("#edit-stuff-name").val(res.name)
				$("#edit-stuff-desc").text(res.desc)
				$("#edit-stuff-owner").val(res.owner)


			},
			error: (err) => {
				console.log(err)
			}
		})

	})

	$("#edit-stuff-store").click(function () {
		let postData = $("#edit-stuff-form").serializeArray();

		let stuffName = postData[0].value
		let stuffDesc = postData[1].value
		let stuffOwner = postData[2].value

		$.ajax({
			url: ajaxurl,
			type: 'post',
			dataType: 'json',
			data: {
				data: [id, stuffName, stuffDesc, stuffOwner],
				action: 'admin_ajax_requests',
				param: 'store_edit_stuff'
			},
			success: (res) => {
				if (res.status) {
					$(".alert-stuff-success").show()
					$(".alert-stuff-failed").hide()
				} else {
					$(".alert-stuff-success").hide()
					$(".alert-stuff-failed").show()
				}
			},
			error: (err) => {
				$(".alert-stuff-failed").show()
				$(".alert-stuff-success").hide()

				console.log(err)
			}
		})
	})

	$('#edit-stuff').on('hidden.bs.modal', function () {
		location.reload()
	})

	$(".btn-delete-stuff").click(function () {

		id = $(this).data("id")

		postdata = "action=admin_ajax_requests&param=delete_stuff&id=" + id

		$.post(ajaxurl, postdata, function (res) {

			resParse = JSON.parse(res)

			if (resParse.status) {
				$(".alert-stuff-deleted-success").show()
				$(".alert-stuff-deleted-failed").hide()
			} else {
				$(".alert-stuff-deleted-success").hide()
				$(".alert-stuff-deleted-failed").show()
			}

			setTimeout(function () {
				location.reload()
			}, 1000)

		})
	})

	$(".btn-borrowing-detail").click(function () {
		id = $(this).data("id")

		postdata = "action=admin_ajax_requests&param=get_borrowing&id=" + id

		$.post(ajaxurl, postdata, function (res) {

			resParse = JSON.parse(res)

			$("#detail-borrowing-title").text(resParse.borrower)
			$("#detail-borrower").text(resParse.borrower)
			$("#detail-stuff").text(resParse.stuff)
			$("#detail-stuff-desc").text(resParse.stuff_desc)

			console.log(resParse)

		})
	})

	$(".btn-detail-stuff").click(function () {
		id = $(this).data("id")

		postdata = "action=admin_ajax_requests&param=get_stuff&id=" + id

		$.post(ajaxurl, postdata, function (res) {

			resParse = JSON.parse(res)

			$("#detail-stuff-title").text(resParse.name)
			$("#detail-stuff-list").text(resParse.name)
			$("#detail-stuff-desc-list").text(resParse.desc)
			$("#detail-stuff-owner").text(resParse.owner)
			
			console.log(resParse)
		})
	})
})
