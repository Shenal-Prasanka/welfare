<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Loan Invoice - {{ $itemLoan->application_id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            padding: 20px;
            background: #f5f5f5;
            font-size: 12px;
        }
        
        .invoice-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .invoice-header {
            text-align: center;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        
        .invoice-header h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .invoice-header p {
            color: #7f8c8d;
            font-size: 16px;
            margin: 2px 0;
        }
        
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        
        .info-section {
            flex: 1;
        }
        
        .info-section h3 {
            color: #2c3e50;
            font-size: 13px;
            margin-bottom: 5px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 3px;
        }
        
        .info-section p {
            margin: 3px 0;
            font-size: 11px;
            color: #555;
        }
        
        .info-section strong {
            color: #2c3e50;
            display: inline-block;
            width: 120px;
        }
        
        .item-details {
            margin: 20px 0;
            border: 2px solid #3498db;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .item-details-header {
            background: #3498db;
            color: white;
            padding: 8px;
            font-size: 13px;
            font-weight: bold;
        }
        
        .item-details-body {
            padding: 10px;
        }
        
        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #ecf0f1;
            font-size: 11px;
        }
        
        .item-row:last-child {
            border-bottom: none;
        }
        
        .item-label {
            font-weight: bold;
            color: #2c3e50;
        }
        
        .item-value {
            color: #555;
        }
        
        .calculation-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            font-size: 12px;
        }
        
        .calculation-table th,
        .calculation-table td {
            padding: 6px;
            text-align: left;
            border-bottom: 1px solid #ecf0f1;
        }
        
        .calculation-table th {
            background: #34495e;
            color: white;
            font-weight: bold;
        }
        
        .calculation-table tr:hover {
            background: #f8f9fa;
        }
        
        .total-row {
            background: #2ecc71 !important;
            color: white !important;
            font-weight: bold;
            font-size: 14px;
        }
        
        .total-row td {
            border-bottom: none;
        }
        
        .guarantor-section {
            margin: 20px 0;
            display: flex;
            gap: 10px;
        }
        
        .guarantor-card {
            flex: 1;
            border: 2px solid rgb(38, 50, 224);
            border-radius: 5px;
            padding: 8px;
        }
        
        .guarantor-card h4 {
            color:rgb(45, 32, 188);
            margin-bottom: 5px;
            font-size: 14px;
        }
        
        .guarantor-card p {
            margin: 2px 0;
            font-size: 12px;
            color: #555;
        }
        
        .footer {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 2px solid #ecf0f1;
            text-align: center;
        }

        .print-button {
            background: #3498db;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin: 20px 0;
        }
        
        .print-button:hover {
            background: #2980b9;
        }
        
        @media print {
            @page {
                size: A4;
                margin: 8mm 12mm;
            }
            
            body {
                background: white;
                padding: 0;
                font-size: 11px;
            }
            
            .invoice-container {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
                height: 100%;
            }
            
            .print-button {
                display: none;
            }
            
            .invoice-header {
                padding-bottom: 8px;
                margin-bottom: 12px;
            }
            
            .invoice-header h1 {
                font-size: 22px;
                margin-bottom: 3px;
            }
            
            .invoice-header p {
                font-size: 10px;
                margin: 1px 0;
            }
            
            .invoice-info {
                margin-bottom: 12px;
            }
            
            .item-details {
                margin: 12px 0;
                page-break-inside: avoid;
            }
            
            .item-details-header {
                padding: 6px;
                font-size: 12px;
            }
            
            .item-details-body {
                padding: 8px;
            }
            
            .item-row {
                padding: 4px 0;
                font-size: 10px;
            }
            
            .calculation-table {
                margin: 12px 0;
                font-size: 10px;
                page-break-inside: avoid;
            }
            
            .calculation-table th,
            .calculation-table td {
                padding: 5px;
            }
            
            .guarantor-section {
                margin: 12px 0;
                page-break-inside: avoid;
                gap: 8px;
            }
            
            .guarantor-card {
                padding: 6px;
            }
            
            .guarantor-card h4 {
                font-size: 11px;
                margin-bottom: 3px;
            }
            
            .guarantor-card p {
                font-size: 9px;
                margin: 1px 0;
            }
            
            .footer {
                margin-top: 12px;
                padding-top: 8px;
                font-size: 9px;
            }
            
            .footer p {
                font-size: 9px;
                line-height: 1.4;
            }
            
            /* Terms and Conditions for print */
            div[style*="background: #ecf0f1"] {
                margin: 10px 0 !important;
                padding: 8px !important;
                page-break-inside: avoid;
            }
            
            div[style*="background: #ecf0f1"] h4 {
                font-size: 11px !important;
                margin-bottom: 4px !important;
            }
            
            div[style*="background: #ecf0f1"] ul {
                font-size: 9px !important;
                line-height: 1.4 !important;
                margin-left: 15px !important;
            }
            
            div[style*="background: #ecf0f1"] li {
                margin: 1px 0 !important;
            }
        }
        
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .badge-success {
            background: #2ecc71;
            color: white;
        }
        
        .badge-info {
            background: #3498db;
            color: white;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        {{-- Print Button --}}
        <div style="text-align: center;">
            <button class="print-button" onclick="window.print()">
                🖨️ Print Invoice
            </button>
        </div>
        
        {{-- Invoice Header --}}
        <div class="invoice-header">
            <h1>🏛️ WELFARE ITEM LOAN INVOICE</h1>
            <p>Sri Lanka Army Welfare Services</p>
            <p>Application ID: <strong>{{ $itemLoan->application_id }}</strong></p>
            <p>Invoice Date: <strong>{{ now()->format('d-M-Y h:i A') }}</strong></p>
        </div>
        
        {{-- Member Information --}}
        <div class="item-details" style="margin-bottom: 15px;">
            <div class="item-details-header">
                👤 MEMBER INFORMATION
            </div>
            <div class="item-details-body">
                <div style="display: flex; gap: 30px;">
                    <div style="flex: 1;">
                        <div class="item-row">
                            <span class="item-label">Name:</span>
                            <span class="item-value">{{ $itemLoan->name }}</span>
                        </div>
                        <div class="item-row">
                            <span class="item-label">Enlisted No:</span>
                            <span class="item-value">{{ $itemLoan->enlisted_no }}</span>
                        </div>
                        <div class="item-row">
                            <span class="item-label">Regiment No:</span>
                            <span class="item-value">{{ $itemLoan->regiment_no }}</span>
                        </div>
                        <div class="item-row">
                            <span class="item-label">Rank:</span>
                            <span class="item-value">{{ $itemLoan->rank ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div style="flex: 1;">
                        <div class="item-row">
                            <span class="item-label">Army ID:</span>
                            <span class="item-value">{{ $itemLoan->army_id }}</span>
                        </div>
                        <div class="item-row">
                            <span class="item-label">NIC:</span>
                            <span class="item-value">{{ $itemLoan->nic ?? 'N/A' }}</span>
                        </div>
                        <div class="item-row">
                            <span class="item-label">Mobile:</span>
                            <span class="item-value">{{ $itemLoan->mobile_no }}</span>
                        </div>
                        <div class="item-row">
                            <span class="item-label">Welfare Membership:</span>
                            <span class="item-value">{{ $itemLoan->welfare_membership ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Item Details --}}
        <div class="item-details">
            <div class="item-details-header">
                📦 ISSUED ITEM DETAILS
            </div>
            <div class="item-details-body">
                <div class="item-row">
                    <span class="item-label">Item Name:</span>
                    <span class="item-value">{{ $stock->item_name }}</span>
                </div>
                <div class="item-row">
                    <span class="item-label">Item Model:</span>
                    <span class="item-value">{{ $stock->item_model }}</span>
                </div>
                <div class="item-row">
                    <span class="item-label">Serial Number:</span>
                    <span class="item-value">{{ $stock->serial_number }}</span>
                </div>
                <div class="item-row">
                    <span class="item-label">Item Code:</span>
                    <span class="item-value">{{ $stock->item_code }}</span>
                </div>
                <div class="item-row">
                    <span class="item-label">Category:</span>
                    <span class="item-value">{{ $stock->product && $stock->product->category ? $stock->product->category->category : $stock->item_category }}</span>
                </div>
                <div class="item-row">
                    <span class="item-label">Welfare Shop:</span>
                    <span class="item-value">{{ $stock->welfare ? $stock->welfare->name : 'N/A' }}</span>
                </div>
            </div>
        </div>

        {{-- Payment Schedule --}}
        <div class="item-details">
            <div class="item-details-header">
                💰 PAYMENT SCHEDULE
            </div>
            <div class="item-details-body">
                <div class="item-row">
                    <span class="item-label">Payment Method:</span>
                    <span class="item-value">Monthly Salary Deduction</span>
                </div>
                <div class="item-row">
                    <span class="item-label">Number of Installments:</span>
                    <span class="item-value">{{ $itemLoan->deduct_time_period }} Months</span>
                </div>
                <div class="item-row">
                    <span class="item-label">Monthly Deduction:</span>
                    <span class="item-value">Rs. {{ number_format($monthlyAmount, 2) }}</span>
                </div>
                <div class="item-row">
                    <span class="item-label">Start Date:</span>
                    <span class="item-value">{{ now()->addMonth()->format('F Y') }}</span>
                </div>
                <div class="item-row">
                    <span class="item-label">End Date:</span>
                    <span class="item-value">{{ now()->addMonths((int)$itemLoan->deduct_time_period)->format('F Y') }}</span>
                </div>
                <div class="item-row">
                    <span class="item-label">Total Payable:</span>
                    <span class="item-value" style="font-weight: bold; color: #2ecc71;">Rs. {{ number_format($totalAmount, 2) }}</span>
                </div>
            </div>
        </div>
        
        {{-- Calculation Table --}}
        <table class="calculation-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th style="text-align: right;">Amount (Rs.)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Item Welfare Price</td>
                    <td style="text-align: right;">{{ number_format($stock->item_welfare_price, 2) }}</td>
                </tr>
                <tr>
                    <td>Deduct Time Period</td>
                    <td style="text-align: right;">{{ $itemLoan->deduct_time_period }} Months</td>
                </tr>
                <tr>
                    <td>Interest Rate</td>
                    <td style="text-align: right;">{{ number_format($interestPercentage, 2) }}%</td>
                </tr>
                <tr>
                    <td>Interest Amount ({{ number_format($interestPercentage, 2) }}% of {{ number_format($stock->item_welfare_price, 2) }})</td>
                    <td style="text-align: right;">{{ number_format($interestAmount, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td>TOTAL AMOUNT PAYABLE</td>
                    <td style="text-align: right;">Rs. {{ number_format($totalAmount, 2) }}</td>
                </tr>
                <tr style="background:rgb(245, 16, 0); color: white; font-weight: bold;">
                    <td>MONTHLY DEDUCTION</td>
                    <td style="text-align: right;">Rs. {{ number_format($monthlyAmount, 2) }}</td>
                </tr>
            </tbody>
        </table>
        
        {{-- Guarantors --}}
        <div class="guarantor-section">
            <div class="guarantor-card">
                <h4>👥 Guarantor 1</h4>
                <p><strong>Name:</strong> {{ $itemLoan->guarantor1_name }}</p>
                <p><strong>Enlisted No:</strong> {{ $itemLoan->guarantor1_enlisted_no }}</p>
                <p><strong>Regiment No:</strong> {{ $itemLoan->guarantor1_regiment_no }}</p>
                <p><strong>Rank:</strong> {{ $itemLoan->guarantor1_rank ?? 'N/A' }}</p>
                <p><strong>Army ID:</strong> {{ $itemLoan->guarantor1_army_id }}</p>
            </div>
            
            <div class="guarantor-card">
                <h4>👥 Guarantor 2</h4>
                <p><strong>Name:</strong> {{ $itemLoan->guarantor2_name }}</p>
                <p><strong>Enlisted No:</strong> {{ $itemLoan->guarantor2_enlisted_no }}</p>
                <p><strong>Regiment No:</strong> {{ $itemLoan->guarantor2_regiment_no }}</p>
                <p><strong>Rank:</strong> {{ $itemLoan->guarantor2_rank ?? 'N/A' }}</p>
                <p><strong>Army ID:</strong> {{ $itemLoan->guarantor2_army_id }}</p>
            </div>
        </div>
        
        {{-- Terms and Conditions --}}
        <div style="margin: 15px 0; padding: 12px; background: #ecf0f1; border-radius: 5px;">
            <h4 style="color: #2c3e50; margin-bottom: 6px; font-size: 14px;">📜 Terms & Conditions:</h4>
            <ul style="margin-left: 20px; color: #555; font-size: 12px; line-height: 1.5; font-weight: bold;">
                <li>Monthly deduction will be automatically deducted from salary.</li>
                <li>Item remains Welfare property until full payment.</li>
                <li>Guarantors responsible for defaults.</li>
                <li>Member must maintain item in good condition.</li>
                <li>Early settlement allowed without penalty.</li>
            </ul>
        </div>
        
        
        {{-- Footer --}}
        <div class="footer">
            <p style="color: #7f8c8d; font-size: 12px;">
                This is a computer-generated invoice and does not require a physical signature.<br>
                For any queries, please contact the Welfare Services Department.<br>
                <strong>Generated on:</strong> {{ now()->format('d-M-Y h:i:s A') }}
            </p>
        </div>
    </div>
</body>
</html>
