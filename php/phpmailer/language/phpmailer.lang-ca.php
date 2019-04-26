ector() {
        Boolean[] array = HwBlob.wrapArray(readBoolVectorAsArray());

        return new ArrayList<Boolean>(Arrays.asList(array));
    }

    /**
     * Convenience method to read a Byte vector as an ArrayList.
     * @return array of parsed values.
     * @throws IllegalArgumentException if the parcel has no more data
     */
    public final ArrayList<Byte> readInt8Vector() {
        Byte[] array = HwBlob.wrapArray(readInt8VectorAsArray());

        return new ArrayList<Byte>(Arrays.asList(array));
    }

    /**
     * Convenience method to read a Short vector as an ArrayList.
     * @return array of parsed values.
     * @throws IllegalArgumentException if the parcel has no more data
     */
    public final ArrayList<Short> readInt16Vector() {
        Short[] array = HwBlob.wrapArray(readInt16VectorAsArray());

        return new ArrayList<Short>(Arrays.asList(array));
    }

    /**
     * Convenience method to read a Integer vector as an ArrayList.
     * @return array of parsed values.
     * @throws IllegalArgumentException if the parcel has no more data
     */
    public final ArrayList<Integer> readInt32Vector() {
        Integer[] array = HwBlob.wrapArray(readInt32VectorAsArray());

        return new ArrayList<Integer>(Arrays.asList(array));
    }

    /**
     * Convenience method to read a Long vector as an ArrayList.
     * @return array of parsed values.
     * @throws IllegalArgumentException if the parcel has no more data
     */
    public final ArrayList<Long> readInt64Vector() {
        Long[] array = HwBlob.wrapArray(readInt64VectorAsArray());

        return new ArrayList<Long>(Arrays.asList(array));
    }

    /**
     * Convenience method to read a Float vector as