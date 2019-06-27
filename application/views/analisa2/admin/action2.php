<script type="text/javascript">
		// UNTUK PEMAHANA BISA GUNAKAN BAGIAN TAFSIRAN KARENA MENGGUNAKAN KOLOM YANG SEDIKIT
		// JIKA DATA DINAMIS DIHAPUS, HASIL PERHITUNGAN TIDAK BERUBAH, GTW KESALAHAN DIMANA...
		// PERHITUNGAN MASIH SALAH
		// lAGI MIKIR ALTERNATIF FORM LAIN

		$(".select2").select2();
		var i=2;
		var sum=0;
		var sumtaksiran=0;
		var taksiran=0;
		//sum += parseFloat($(".hitjumlah").val());
		$("#add_satuan").click(function() {
			//HAPUS SELECT2
			$(".select2").select2().select2('destroy');
			//AMBIL CLASS FORM YANG AKAN DITAMPILKAN
			pre=$(".pre").html();
			//TAMPILKAN DATA
			$(".satuan").prepend(pre);
			//INISIASI SELECT2
			$(".select2").select2();
			//HAPUS ATRIBUT DARI FORM MASTER/FORM YANG AKAN DITAMPILKAN, JIKA TIDAK UPDATE DATA TIDAK TEPAT
			$("#inptsat").removeClass('sat');
			$("#jumlah").removeClass('jumlah');
			//ADD ATRIBUT UNTUK FORM DINAMIS YANG DITAMBHAKAN/KEPERLUAN HITUNGAN
			$("#add1").attr('identity','id'+i);
			//AMBIL ATRIBUT SELECT2 SATUAN, DAN TAMBAHKAN KE MASING2 KOLOM YANG BERKAITAN, AGAR PERHITUNGANNYA TEPAT
			$("[identity=id"+i+"]").attr('id','idx'+i);			
			$("#inptsat").attr('satidentity','idx'+i);
			$("#jumlah").attr('jumidentity','idx'+i);
			$("#inptkoefisien").attr('koeidentity','idx'+i);

			//TIAP SELECT2 YANG DIHASILKAN DARI FORM BARU HARUS DIBUAT FUNGSINYA SEPERTI DUBAWAH
			//PERHATIKAN ADA VARIABEL YANG MELAKUKAN INCREMENT
			$("#idx"+i).change(function(){
				//AMBIL PARAMETER DARI SELECT2
				val=$(this).val();
				ids=$(this).attr('id');
				identity=$(this).attr('identity');
				//SET IDENTITY YANG SAMA DENGAN SELECT2, UNTUK TES ENABLE SCRIPT DIBAWAH
				//$("."+identity).html(identity);
				
				//AMBIL NILAI HARGA PADA SELECT2 YANG DIPILIH, PARAMATER HIDEN
				harga=$("#"+ids).select2().find(":selected").attr("harga");
				//SET HARGA KE MASING2 IDENTITY
				$("[satidentity="+ids+"]").val(harga);
				bilkoe=$("[koeidentity="+ids+"]").val();
				resjumlah=bilkoe*harga;
				$("[jumidentity="+ids+"]").val(resjumlah);
				//LAKUKAN PENJUMLAHAN
				sum += parseFloat($("[jumidentity="+ids+"]").val());
			})
			i++;
			// var sum = 0;
			// $('.hitjumlah').each(function(){
			//     sum += parseFloat(this.value);
			// });												
		})
		$(".selectsatuan").change(function(){
			//FUNGSI MENANGKAP PERUBAHAN PADA SELECT2 MASTER
			id=$(this).val();
			harga=$("#add1").select2().find(":selected").attr("harga");
			bilkoe=$("#inptkoefisien").val();
			resjumlah=bilkoe*harga;
			$(".sat").val(harga);
			$(".jumlah").val(resjumlah);
			sum += parseFloat($(".hitjumlah").val());
			//alert(harga);
		})		
		$("#hitungjumlah").click(function(){
			//FUNGSI JUMLAH HASIL
			$("[name=analisa_harga]").val(sum);					
		})

		$(".selecttaksiran").change(function(){
			//FUNGSI MENANGKAP PERUBAHAN SELECT PADA TAFSIRAN
			id=$(this).val();
			harga=$("#taksiranadd1").select2().find(":selected").attr("harga");
			$(".harga").val(harga);
			taksiran = parseFloat($("#taksiran_harga").val());	
			//alert(taksiran);
		})		
		$("#add_tafsiran").click(function() {
			$(".select2").select2().select2('destroy');
			pre=$(".formtafsiran").html();
			$(".tafsiran").prepend(pre);
			$(".select2").select2();
			
			$("#taksiranadd1").attr('identity','id'+i);
			$("#taksiran_harga").removeClass('harga');
			$("[identity=id"+i+"]").attr('id','idx'+i);
			$("#taksiran_harga").attr('hargaidentity','idx'+i);
			//KETERANGAN LIHAT KETERANGAN FORM SATUAN
			$("#idx"+i).change(function(){
				val=$(this).val();
				ids=$(this).attr('id');
				identity=$(this).attr('identity');
				$("."+identity).html(identity);
				harga=$("#"+ids).select2().find(":selected").attr("harga");
				$("[hargaidentity="+ids+"]").val(harga);
				sumtaksiran += parseFloat($("[hargaidentity="+ids+"]").val());
			})
			// sumtaksiran += parseFloat($(".harga").val());
			i++;												
		})					
		$("#hitungtaksiran").click(function(){
			var total=taksiran+sumtaksiran;
			$("[name=totaltafsiran]").val(total);					
		})			
		$("#remove_satuan").click(function(){
			//FUNGSI REMOVE, REMOVE ID PALING AWAL, AKAN TERHAPUS DARI ATAS
			id=$('div#hello').length;
			sumtaksiran=0;
			if(id>1){
				$("#hello").parent().remove();
			}
		});
		$("#remove_tafsiran").click(function(){
			id=$('div#taksiran_remove').length;
			if(id>1){
				$("#taksiran_remove").parent().remove();
			}
		});		
		// $("body").on("click",".remove_satuan",function(){ 
		// 	$(this).parents(".form-group").remove();
		// });
</script>