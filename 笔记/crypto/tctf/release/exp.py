import z3
def solve_lfsr(results, index1, index2, length):
    s = z3.Solver()
    x = init_recovered = z3.BitVec('x', length)
    for result in results:
        relevant_bit1 = init_recovered & (1 << index1)
        bit1_value = z3.LShR(relevant_bit1, index1)

        relevant_bit2 = init_recovered & (1 << index2)
        bit2_value = z3.LShR(relevant_bit2, index2)

        s.add(bit1_value ^ bit2_value == result)

        init_recovered = ((init_recovered << 1) & (2 ** (length + 1) - 1)) ^ result
    s.check()
    return long_to_bytes(int(str(s.model()[x])))