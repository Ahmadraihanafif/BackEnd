// import Model Student
const Student = require("../models/Student");

class StudentController {
  // menambahkan keyword async
  async index(req, res) {
    // memanggil method static all dengan async await.
    const students = await Student.all();

    const data = {
      message: "Menampilkkan semua students",
      data: students,
    };

    res.json(data);
  }

  /**
   * TODO 2: memanggil method create.
   * Method create mengembalikan data yang baru diinsert.
   * Mengembalikan response dalam bentuk json.
   */
  // code here
  // const { nama, nim, email, jurusan } = req.body
  // const students = await Student.create(nama, nim, email, jurusan);
  async store(req, res) {
    const student = await Student.create(req.body);
    const data = {
      message: "Menambahkan data student",
      data: student,
    };

    res.json(data);
  }

  async update(req, res) {
    const { id } = req.params;

    const student = await Student.find(id);

    if (student) {
      const student = await Student.update(id, req.body);
      const data = {
        messege: `mengedit data students`,
        data: student,
      };
      res.status(200).json(data);
    } else {
      const data = {
        messege: `student not found`,
      };
      res.status(404).json(data);
    }
  }

  async destroy(req, res) {
    const { id } = req.params;
    const student = await Student.find(id);

    if (student) {
      await Student.delete(id);
      const data = {
        messege: `Menghapus data students`,
      };
      res.status(200).json(data);
    } else {
      const data = {
        messege: `Student not found`,
      };
      res.status(404).json(data);
    }

    const data = {
      message: `Menghapus student id ${id}`,
      data: [],
    };

    res.json(data);
  }
  async show(req, res) {
    const { id } = req.params;
    const student = await Student.find(id);
    if (student) {
      const data = {
        message: `Menapilkan detail data students`,
        data: student,
      };
      res.status(200).json(data);
    } else {
      const data = {
        messege: `Students not found`,
      };
      res.status(404).json(data);
    }
  }
}

// Membuat object StudentController
const object = new StudentController();

// Export object StudentController
module.exports = object;
