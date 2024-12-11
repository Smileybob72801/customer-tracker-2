import json
import sys

from customers import get_all_customers

try:
    customers = get_all_customers()
    print(json.dumps(customers))
except Exception as e:
    print(json.dumps({"error": str(e)}))
    sys.exit(1)