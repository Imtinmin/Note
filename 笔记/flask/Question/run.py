#!/usr/bin/env python3

from app import app

if __name__ == '__main__':
    app.run('0.0.0.0','9999',debug=True)