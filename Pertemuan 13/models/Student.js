// import database
const { resolve } = require("path");
const db = require("../config/database");

// membuat class Model Student
class Student {
  /**
   * Membuat method static all.
   */
  static all() {
    // return Promise sebagai solusi Asynchronous
    return new Promise((resolve, reject) => {
      const sql = "SELECT * from students";
      /**
       * Melakukan query menggunakan method query.
       * Menerima 2 params: query dan callback
       */
      db.query(sql, (err, results) => {
        resolve(results);
      });
    });
  }

  /**
   * TODO 1: Buat fungsi untuk insert data.
   * Method menerima parameter data yang akan diinsert.
   * Method mengembalikan data student yang baru diinsert.
   */

  static create(nama, nim, email, jurusan) {
    // code here
    return new Promise((resolve, reject) => {
      const sql = `INSERT INTO students (nama, nim, email, jurusan,created_at) VALUES ('${nama}', '${nim}', '${email}', '${jurusan}', now())`;
      db.query(sql, (err, results) => {
        resolve(results);
      });
    });
  }

  static async create(data) {
    //melakukan insert data ke database
    const id = await new Promise((resolve, reject) => {
      const sql = "INSERT INTO students SET ?";
      db.query(sql, data, (err, results) => {
        resolve(results.insertId);
      });
    });
    //melakukan query berdasarkan id
    return new Promise((resolve, reject) => {
      const sql = "SELECT * FROM students WHERE id =?";
      db.query(sql, id, (err, results) => {
        resolve(results);
      });
    });
  }
  static find(id) {
    // melakukan query berdasarkan id
    return new Promise((resolve, reject) => {
      const sql = "SELECT * FROM students WHERE id = ?";
      db.query(sql, id, (err, result) => {
        // destructing array
        const [student] = result;
        resolve(student);
      });
    });
  }

  static async update(id, data) {
    await new Promise((resolve, reject) => {
      const sql = "UPDATE students SET ? WHERE id = ?";
      db.query(sql, [data, id], (err, result) => {
        resolve(result);
      });
    });

    const student = this.find(id);
    return student;
  }
  static delete(id) {
    return new Promise((resolve, reject) => {
      const sql = "DELETE FROM students WHERE id = ?";
      db.query(sql, id, (err, result) => {
        resolve(result);
      });
    });
  }
}
// export class Student
module.exports = Student;
