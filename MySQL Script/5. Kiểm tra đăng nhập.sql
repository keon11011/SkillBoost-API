-- Nhập biến email
SET @email = 'ngphthanh@gmai.com'; -- điền field từ frontend

-- Kiểm tra có tồn tại tài khoản hay không
SELECT COUNT(*) INTO @KtrTonTai FROM TAIKHOAN WHERE EmailTK = @email;

-- Lấy trạng thái tài khoản
SELECT TrangThaiTK INTO @TrangThaiTK FROM TAIKHOAN WHERE EmailTK = @email;

-- Nhập biến MKNhapVao
SET @MKNhapVao = 'secretKey';

-- Hash MKNhapVao với MaSaltTK
SELECT SHA2(CONCAT(@MKNhapVao, MaSaltTK), 256) INTO @MaHashMKNhapVao FROM TAIKHOAN WHERE EmailTK = @email;

-- Lấy MatKhauTK
SELECT MatKhauTK INTO @MKHash FROM TAIKHOAN WHERE EmailTK = @email;

SELECT IF (@KtrTonTai = 1 AND  @TrangThaiTK = 'Đang hoạt động' AND @MaHashMKNhapVao = @MKHash,'true','false');