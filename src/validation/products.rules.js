import { body, param } from 'express-validator';
export const productCreateRules = [
  body('name').isString().isLength({ min: 3 }).withMessage('El nombre debe tener al menos 3 caracteres'), // CAMBIO
  body('price').isFloat({ min: 0 }),
  body('stock').isInt({ min: 0 }),
  body('sku').optional().matches(/^[A-Z0-9-]+$/).withMessage('Formato SKU inválido (A-Z, 0-9, -)'),
  body('supplierId').optional().isMongoId() 
];
export const productUpdateRules = [
  param('id').isMongoId(),
  body('name').optional().isString().isLength({ min: 2 }),
  body('price').optional().isFloat({ min: 0 }),
  body('stock').optional().isInt({ min: 0 }),
  body('sku').optional().matches(/^[A-Z0-9-]+$/),
  body('active').optional().isBoolean()
];
