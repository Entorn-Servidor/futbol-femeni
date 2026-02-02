import mongoose from 'mongoose';
const productSchema = new mongoose.Schema({
  name:   { type: String, required: true, trim: true, minlength: 3 },
  sku:    { 
            type: String, 
            unique: true, 
            sparse: true, 
            trim: true, 
            match: /^[A-Z0-9-]+$/
          },
  price:  { type: Number, required: true, min: 0 },
  stock:  { type: Number, required: true, min: 0 },
  active: { type: Boolean, default: true },
  supplierId: { type: mongoose.Schema.Types.ObjectId, ref: 'Supplier' }
}, { timestamps: true });
export const Product = mongoose.model('Product', productSchema);
