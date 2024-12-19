<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

/**
 * @OA\Info(title="Mahasiswa API", version="1.0.0")
 * @OA\Server(url="http://localhost/api")
 * @OA\Components(
 *   @OA\Schema(
 *     schema="MahasiswaListResponse",
 *     type="object",
 *     @OA\Property(
 *       property="data",
 *       type="array",
 *       @OA\Items(ref="#/components/schemas/Mahasiswa")
 *     )
 *   ),
 *   @OA\Schema(
 *     schema="MahasiswaRequest",
 *     type="object",
 *     @OA\Property(property="nim", type="string"),
 *     @OA\Property(property="nama", type="string"),
 *     @OA\Property(property="alamat", type="string"),
 *     @OA\Property(property="tanggal_lahir", type="date"),
 *     @OA\Property(property="jurusan", type="string")
 *     
 *   ),
 *   @OA\Schema(
 *     schema="MahasiswaResponse",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="nim", type="string"),
 *     @OA\Property(property="nama", type="string"),
 *     @OA\Property(property="alamat", type="string"),
 *     @OA\Property(property="tanggal_lahir", type="date"),
 *     @OA\Property(property="jurusan", type="string")
 *   ),
 *   @OA\Schema(
 *     schema="DeleteMahasiswaResponse",
 *     type="object",
 *     @OA\Property(property="message", type="string")
 *   ),
 *   @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 *   )
 * )
 */
class MahasiswaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/mahasiswas",
     *     summary="Dapatkan daftar semua mahasiswa",
     *     description="Mengembalikan daftar semua mahasiswa",
     *     operationId="getMahasiswa",
     *     tags={"Mahasiswa"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Daftar mahasiswa",
     *         @OA\JsonContent(ref="#/components/schemas/MahasiswaListResponse")
     *     )
     * )
     */
    public function index()
    {
        return Mahasiswa::all();
    }

    /**
     * @OA\Post(
     *     path="/api/mahasiswas",
     *     summary="Tambahkan mahasiswa baru",
     *     description="Menambahkan mahasiswa baru ke dalam sistem",
     *     operationId="createMahasiswa",
     *     tags={"Mahasiswa"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/MahasiswaRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Mahasiswa berhasil ditambahkan",
     *         @OA\JsonContent(ref="#/components/schemas/MahasiswaResponse")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Data tidak valid"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jurusan' => 'required',
        ]);
        return Mahasiswa::create($request->all());
    }

    /**
     * @OA\Put(
     *     path="/api/mahasiswas/{id}",
     *     summary="Perbarui data mahasiswa",
     *     description="Memperbarui informasi mahasiswa berdasarkan ID",
     *     operationId="updateMahasiswa",
     *     tags={"Mahasiswa"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID mahasiswa yang akan diperbarui",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/MahasiswaRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mahasiswa berhasil diperbarui",
     *         @OA\JsonContent(ref="#/components/schemas/MahasiswaResponse")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Data tidak valid"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mahasiswa tidak ditemukan"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $mahasiswas = Mahasiswa::findOrFail($id);
        $mahasiswas->update($request->all());
        return $mahasiswas;
    }

    /**
     * @OA\Delete(
     *     path="/api/mahasiswas/{id}",
     *     summary="Hapus mahasiswa",
     *     description="Menghapus data mahasiswa berdasarkan ID",
     *     operationId="deleteMahasiswa",
     *     tags={"Mahasiswa"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID mahasiswa yang akan dihapus",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mahasiswa berhasil dihapus",
     *         @OA\JsonContent(ref="#/components/schemas/DeleteMahasiswaResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mahasiswa tidak ditemukan"
     *     )
     * )
     */
    public function destroy($id)
    {
        Mahasiswa::destroy($id);
        return response()->json(null, 200);
    }
}
