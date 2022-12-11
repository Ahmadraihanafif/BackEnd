/**
 * Fungsi untuk menampilkan hasil download
 * @param {string} result - Nama file yang didownload
 */
const showDownload = () => {
  const result = "windows-10.exe";
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve("Download Selesai, Hasil download " + result);
    }, 3000);
  });
};

/**
 * Fungsi untuk download file
 * @param {function} callback - Function callback show
 */
const download = () => {
  showDownload().then((res) => {
    console.log(res);
    return showDownload();
  });
};
download();

/**
 * TODO:
 * - Refactor callback ke Promise atau Async Await
 * - Refactor function ke ES6 Arrow Function
 * - Refactor string ke ES6 Template Literals
 */
