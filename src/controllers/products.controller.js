import { Product } from '../models/product.model.js';

export async function list(req, res, next) {
  try {
    const { q, active, sort } = req.query;

    const page = Math.max(parseInt(req.query.page ?? '1', 10), 1);
    const limit = Math.min(Math.max(parseInt(req.query.limit ?? '10', 10), 1), 100);
    const skip = (page - 1) * limit;

    const filter = {};
    if (q) {
      filter.$or = [
        { name: { $regex: q, $options: 'i' } }, 
        { sku: { $regex: q, $options: 'i' } }
      ];
    }
    if (active !== undefined) filter.active = active === 'true';

    let sortOptions = { createdAt: -1 }; 
    if (sort) {
      const [field, direction] = sort.split(':');
      sortOptions = { [field]: direction === 'asc' ? 1 : -1 };
    }

    const [total, data] = await Promise.all([
      Product.countDocuments(filter),
      Product.find(filter)
             .sort(sortOptions)
             .skip(skip)
             .limit(limit)
             .populate('supplierId', 'name email cif') 
             .lean()
    ]);

    res.json({
      data,
      page,
      limit,
      total,
      pages: Math.ceil(total / limit)
    });
  } catch (err) { next(err); }
}

export async function getById(req, res, next) {
  try {
    const product = await Product.findById(req.params.id).lean();
    if (!product) return res.status(404).json({ error: 'No trobat' });
    res.json(product);
  } catch (err) { next(err); }
}

export async function create(req, res, next) {
  try {
    const created = await Product.create(req.body);
    res.status(201).json(created);
  } catch (err) {
    if (err?.code === 11000) return res.status(409).json({ error: 'SKU duplicat' });
    if (err?.name === 'ValidationError') return res.status(422).json({ error: err.message });
    next(err);
  }
}

export async function update(req, res, next) {
  try {
    const updated = await Product.findByIdAndUpdate(req.params.id, req.body, { new: true, runValidators: true }).lean();
    if (!updated) return res.status(404).json({ error: 'No trobat' });
    res.json(updated);
  } catch (err) {
    if (err?.code === 11000) return res.status(409).json({ error: 'SKU duplicat' });
    if (err?.name === 'ValidationError') return res.status(422).json({ error: err.message });
    next(err);
  }
}

export async function remove(req, res, next) {
  try {
    const out = await Product.findByIdAndDelete(req.params.id).lean();
    if (!out) return res.status(404).json({ error: 'No trobat' });
    res.status(204).send();
  } catch (err) { next(err); }
}

export async function exportCSV(req, res, next) {
  try {
    const products = await Product.find().lean();

    let csv = 'ID,Name,SKU,Price,Stock\n';

    products.forEach(p => {
      csv += `${p._id},"${p.name}",${p.sku || ''},${p.price},${p.stock}\n`;
    });

    res.header('Content-Type', 'text/csv');
    res.header('Content-Disposition', 'attachment; filename="productos.csv"');
    
    res.send(csv);
  } catch (err) { next(err); }
}
