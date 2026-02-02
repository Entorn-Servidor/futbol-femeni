import { Supplier } from '../models/supplier.model.js';

export async function list(req, res, next) {
  try {
    const data = await Supplier.find().sort({ name: 1 }).lean();
    res.json(data);
  } catch (err) {
    next(err);
  }
}

export async function getById(req, res, next) {
  try {
    const supplier = await Supplier.findById(req.params.id).lean();
    if (!supplier) return res.status(404).json({ error: 'Proveedor no encontrado' });
    res.json(supplier);
  } catch (err) {
    next(err);
  }
}

export async function create(req, res, next) {
  try {
    const created = await Supplier.create(req.body);
    res.status(201).json(created);
  } catch (err) {
    if (err.code === 11000) {
      return res.status(409).json({ error: 'El proveedor (Nombre, Email o CIF) ya existe' });
    }
    next(err);
  }
}

export async function update(req, res, next) {
  try {
    const updated = await Supplier.findByIdAndUpdate(req.params.id, req.body, { 
      new: true, 
      runValidators: true 
    }).lean();

    if (!updated) return res.status(404).json({ error: 'Proveedor no encontrado' });
    res.json(updated);
  } catch (err) {
    if (err.code === 11000) {
      return res.status(409).json({ error: 'Datos duplicados con otro proveedor' });
    }
    next(err);
  }
}

export async function remove(req, res, next) {
  try {
    const deleted = await Supplier.findByIdAndDelete(req.params.id).lean();
    if (!deleted) return res.status(404).json({ error: 'Proveedor no encontrado' });
    
    res.status(204).send();
  } catch (err) {
    next(err);
  }
}